<?php

namespace App\Repositories\Backend\Supplies;

use App\Exceptions\GeneralException;
use App\Models\Supply;
use App\Models\User;
use Auth;
use DB;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class SupplyRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Supply::class;

    public function getForDataTable()
    {
        return $this->query()->select('supplies.*', 'users.username')
        ->leftJoin('users', 'users.id', '=', 'supplies.user_id');
    }

    public function create($input)
    {
        $user = User::where('id', $input['user_id'])->first();

        if (!$user) {
            throw new GeneralException("会员不存在！");
        }

        $supply = self::MODEL;
        $supply = new $supply;
        $supply->title = $input['title'];
        //$supply->slug = $input['slug'];
        $supply->user_id = $user->id;
        $supply->price = $input['price'];
        $supply->unit = $input['unit'];
        $supply->content = $input['content'];
        $supply->images = $input['images'];
        $supply->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($supply) {
            if (parent::save($supply)) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $supply, array $input)
    {
        DB::transaction(function () use ($supply, $input) {
            if (parent::update($supply, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $supply)
    {
        if (parent::delete($supply)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $supply)
    {
        if (is_null($supply->deleted_at)) {
            throw new GeneralException('供应不能恢复！');
        }
        if (parent::restore($supply)) {
            return true;
        }
        throw new GeneralException('恢复失败！');
    }

    public function delete(Model $supply)
    {
        if (is_null($supply->deleted_at)) {
            throw new GeneralException('要先删除供应！');
        }
        DB::transaction(function () use ($supply) {
            if (parent::forceDelete($supply)) {
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
        return $this->query()->where('user_id', Auth::id())->orderBy('is_excellent')
                    ->orderBy('created_at', 'DESC')->paginate();
    }

    public function createFavorite(Model $supply)
    {
        $favorites = $supply->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            throw new GeneralException('你已经收藏！');
        }
        $supply->favorites()->create(['user_id' => Auth::id()]);
    }
}
