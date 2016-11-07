<?php

namespace App\Repositories\Backend\Supplies;

use App\Exceptions\GeneralException;
use App\Models\Supplies\Supply;
use App\Models\Users\User;
use Auth;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class SupplyRepository implements SupplyInterface
{


    public function getForDataTable()
    {
        return Supply::select('supplies.*', 'users.username')
        ->leftJoin('users', 'users.id', '=', 'supplies.user_id');
    }

    public function create($input)
    {
        $user = User::where('id', $input['user_id'])->first();

        if (!$user) {
            throw new GeneralException("会员不存在！");
        }

        $supply = new Supply;
        $supply->title = $input['title'];
        //$supply->slug = $input['slug'];
        $supply->user_id = $user->id;
        $supply->price = $input['price'];
        $supply->unit = $input['unit'];
        $supply->content = $input['content'];
        $supply->images = $input['images'];
        $demand->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($supply) {
            if ($supply->save()) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Supply $supply, $input)
    {
        $supply->title = $input['title'];
        //$supply->slug = $input['slug'];
        $supply->price = $input['price'];
        $supply->unit = $input['unit'];
        $supply->content = $input['content'];
        $supply->images = $input['images'];
        $demand->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($supply) {
            if ($supply->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $supply = $this->findOrThrowException($id);
        if ($supply->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $supply = $this->findOrThrowException($id);
        if ($supply->restore()) {
            return true;
        }
        throw new GeneralException('恢复失败！');
    }

    public function delete($id)
    {
        $supply = $this->findOrThrowException($id);
        if ($supply->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $supply = Supply::withTrashed()->find($id);

        if (!is_null($supply)) {
            return $supply;
        }

        throw new GeneralException('未找到供应信息');
    }
}
