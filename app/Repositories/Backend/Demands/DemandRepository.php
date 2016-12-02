<?php

namespace App\Repositories\Backend\Demands;

use App\Exceptions\GeneralException;
use App\Models\Demands\Demand;
use App\Models\Users\User;
use Auth;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class DemandRepository implements DemandInterface
{
    protected $demand;

    public function __construct(Demand $demand)
    {
        $this->demand = $demand;
    }



    public function getForDataTable()
    {
        return Demand::select('demands.*', 'users.username')
        ->leftJoin('users', 'users.id', '=', 'demands.user_id');
    }

    public function create($input)
    {
        $user = User::where('id', $input['user_id'])->first();

        if (!$user) {
            throw new GeneralException("会员不存在！");
        }

        $demand = new Demand;
        $demand->title = $input['title'];
        //$demand->slug = $input['slug'];
        $demand->user_id = $user->id;
        $demand->quantity = $input['quantity'];
        $demand->unit = $input['unit'];
        $demand->content = $input['content'];
        $demand->images = $input['images'];
        $demand->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($demand) {
            if ($demand->save()) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Demand $demand, $input)
    {
        $demand->title = $input['title'];
        //$demand->slug = $input['slug'];
        $demand->quantity = $input['quantity'];
        $demand->unit = $input['unit'];
        $demand->content = $input['content'];
        $demand->images = $input['images'];
        $demand->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($demand) {
            if ($demand->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $demand = $this->findOrThrowException($id);
        if ($demand->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $demand = $this->findOrThrowException($id);
        if ($demand->restore()) {
            return true;
        }
        throw new GeneralException('恢复失败！');
    }

    public function delete($id)
    {
        $demand = $this->findOrThrowException($id);
        if ($demand->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $demand = Demand::withTrashed()->find($id);

        if (!is_null($demand)) {
            return $demand;
        }

        throw new GeneralException('未找到需求信息');
    }

    public function search($input)
    {
        return $this->demand->where('title', 'like', "%$input->q%")->orWhere('content', 'like', "%$input->q%")->paginate();
    }
}
