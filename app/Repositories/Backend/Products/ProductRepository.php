<?php

namespace App\Repositories\Backend\Products;

use App\Exceptions\GeneralException;
use App\Models\Product;
use App\Models\User;
use Auth;
use DB;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class ProductRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Product::class;

    public function getForDataTable()
    {
        return $this->query()->select('products.*', 'users.username')
        ->leftJoin('users', 'users.id', '=', 'products.user_id');
    }

    public function create($input)
    {
        $user = User::where('id', $input['user_id'])->first();

        if (!$user) {
            throw new GeneralException("会员不存在！");
        }

        $product = self::MODEL;
        $product = new $product;
        $product->title = $input['title'];
        //$product->slug = $input['slug'];
        $product->user_id = $input['user_id'];
        $product->price = $input['price'];
        $product->unit = $input['unit'];
        $product->content = $input['content'];
        $product->images = $input['images'];

        DB::transaction(function () use ($product) {
            if (parent::save($product)) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $product, array $input)
    {
        DB::transaction(function () use ($product, $input) {
            if (parent::update($product, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $product)
    {
        if (parent::delete($product)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $product)
    {
        if (is_null($product->deleted_at)) {
            throw new GeneralException('产品不能恢复！');
        }

        if (parent::restore($product)) {
            return true;
        }
        throw new GeneralException('恢复失败！');
    }

    public function delete(Model $product)
    {
        if (is_null($product->deleted_at)) {
            throw new GeneralException('要先删除产品！');
        }
        DB::transaction(function () use ($product) {
            if (parent::forceDelete($product)) {
                return true;
            }
            throw new GeneralException('删除失败！');
        });
    }
    public function indexByUser()
    {
        $user = Auth::user();
        return $user->products()->paginate();
    }

    public function createFavorite(Model $product)
    {
        $favorites = $product->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            throw new GeneralException('你已经收藏！');
        }
        $product->favorites()->create(['user_id' => Auth::id()]);
    }

    public function index()
    {
        return $this->query()->where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate();
    }

    public function search($input)
    {
        return $this->query()->where('title', 'like', "%$input->q%")->orWhere('content', 'like', "%$input->q%")->paginate();
    }

    public function searchWithUser($input)
    {
        return $this->query()->where('user_id', Auth::id())->where(function ($query) use ($request) {
            $query->where('title', 'like', "%$request->q%")->orWhere('content', 'like', "%$request->q%");
        })->paginate();
    }
}
