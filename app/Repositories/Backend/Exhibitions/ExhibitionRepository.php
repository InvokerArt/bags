<?php

namespace App\Repositories\Backend\Exhibitions;

use App\Exceptions\GeneralException;
use App\Models\Exhibition;
use App\Models\CategoriesExhibition;
use App\Models\Tag;
use App\Repositories\Backend\Tags\TagsInterface;
use Carbon;
use DB;
use Auth;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class ExhibitionRepository implements ExhibitionInterface
{


    public function getForDataTable()
    {
        /**
         * withCount--统计关联的结果而不实际的加载它们。
         */
        return Exhibition::with('categories');
    }

    public function create($input)
    {
        $exhibition = new Exhibition;
        $exhibition->title = $input['title'];
        //$exhibition->slug = $input['slug'];
        $exhibition->user_id = Auth::guard('admin')->id();
        $exhibition->subtitle = $input['subtitle'];
        $exhibition->address = $input['address'];
        $exhibition->telephone = $input['telephone'];
        $exhibition->content = $input['content'];
        $exhibition->image = $input['image'];
        $exhibition->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();
        $exhibition->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($exhibition, $input) {
            if ($exhibition->save()) {
                $categories_id = explode(',', $input['categories_id']);
                $exhibition->attachCategories($categories_id);
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Exhibition $exhibition, $input)
    {
        $exhibition->title = $input['title'];
        $exhibition->subtitle = $input['subtitle'];
        $exhibition->address = $input['address'];
        $exhibition->telephone = $input['telephone'];
        $exhibition->content = $input['content'];
        $exhibition->image = $input['image'];
        $exhibition->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();
        $exhibition->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($exhibition, $input) {
            if ($exhibition->update()) {
                $categories_id = explode(',', $input['categories_id']);
                $exhibition->syncCategories($categories_id);

                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $exhibition = Exhibition::find($id);
        if ($exhibition->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $exhibition = Exhibition::find($id);
        if ($exhibition->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $exhibition = Exhibition::find($id);
        if ($exhibition->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
