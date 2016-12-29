<?php

namespace App\Repositories\Backend\Demands;

use App\Exceptions\GeneralException;
use App\Models\Demand;
use App\Models\User;
use App\Repositories\Repository;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class DemandRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Demand::class;

    public function getForDataTable()
    {
        return $this->query()->select('demands.*', 'users.username')
        ->leftJoin('users', 'users.id', '=', 'demands.user_id');
    }

    public function create($input)
    {
        $user = User::where('id', $input['user_id'])->first();

        if (!$user) {
            throw new GeneralException("会员不存在！");
        }

        $demand = self::MODEL;
        $demand = new $demand;
        $demand->title = $input['title'];
        //$demand->slug = $input['slug'];
        $demand->user_id = $user->id;
        $demand->quantity = $input['quantity'];
        $demand->unit = $input['unit'];
        $demand->content = $input['content'];
        $demand->images = $input['images'];
        $demand->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($demand) {
            if (parent::save($demand)) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $demand, array $input)
    {
        DB::transaction(function () use ($demand, $input) {
            if (parent::update($demand, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $demand)
    {
        if (parent::delete($demand)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $demand)
    {
        if (is_null($demand->deleted_at)) {
            throw new GeneralException('需求不能恢复！');
        }
        if (parent::restore($demand)) {
            return true;
        }
        throw new GeneralException('恢复失败！');
    }

    public function delete(Model $demand)
    {
        if (is_null($demand->deleted_at)) {
            throw new GeneralException('要先删除需求！');
        }
        DB::transaction(function () use ($demand) {
            if (parent::forceDelete($demand)) {
                return true;
            }
            throw new GeneralException('删除失败！');
        });
    }

    public function search($input)
    {
        return $this->query()->where('title', 'like', "%$input->q%")->orWhere('content', 'like', "%$input->q%")->paginate();
    }

    public function searchWithUser($input)
    {
        return $this->query()->where('user_id', Auth::id())->where(function ($query) use ($input) {
            $query->where('title', 'like', "%$input->q%")->orWhere('content', 'like', "%$input->q%");
        })->paginate();
    }

    public function index()
    {
        return $this->query()->orderBy('created_at', 'DESC')->paginate();
    }

    public function indexByUser()
    {
        return $this->query()->where('user_id', Auth::id())->orderBy('is_excellent')->orderBy('created_at', 'DESC')->paginate();
    }

    public function createFavorite(Model $demand)
    {
        $favorites = $demand->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            throw new GeneralException('你已经收藏！');
        }
        $demand->favorites()->create(['user_id' => Auth::id()]);
    }
}
