<?php

namespace App\Repositories\Backend\Products;

use App\Exceptions\GeneralException;
use App\Models\Products\Product;
use App\Models\Users\User;
use Auth;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class ProductRepository implements ProductInterface
{


    public function getForDataTable()
    {
        return Product::select('products.*', 'users.username')
        ->leftJoin('users', 'users.id', '=', 'products.user_id');
    }

    public function create($input)
    {
        $user = User::where('id', $input['user_id'])->first();

        if (!$user) {
            throw new GeneralException("会员不存在！");
        }

        $product = new Product;
        $product->title = $input['title'];
        //$product->slug = $input['slug'];
        $product->user_id = $input['user_id'];
        $product->price = $input['price'];
        $product->unit = $input['unit'];
        $product->content = $input['content'];
        $product->images = $input['images'];

        DB::transaction(function () use ($product) {
            if ($product->save()) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Product $product, $input)
    {
        $product->title = $input['title'];
        //$product->slug = $input['slug'];
        $product->price = $input['price'];
        $product->unit = $input['unit'];
        $product->content = $input['content'];
        $product->images = $input['images'];

        DB::transaction(function () use ($product) {
            if ($product->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $product = $this->findOrThrowException($id);
        if ($product->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $product = $this->findOrThrowException($id);
        if ($product->restore()) {
            return true;
        }
        throw new GeneralException('恢复失败！');
    }

    public function delete($id)
    {
        $product = $this->findOrThrowException($id);
        if ($product->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $product = Product::withTrashed()->find($id);

        if (!is_null($product)) {
            return $product;
        }

        throw new GeneralException('未找到招聘信息');
    }
}
