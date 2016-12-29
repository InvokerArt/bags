<?php

namespace App\Repositories\Backend\Exhibitions;

use App\Models\CategoriesExhibitions;
use App\Exceptions\GeneralException;
use App\Helper\Catalog\Image;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use DB;

class CategoryRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = CategoriesExhibitions::class;

    public function update(Model $category, array $input)
    {
        DB::transaction(function () use ($category, $input) {
            if (parent::update($category, $input)) {
                return true;
            }

            throw new GeneralException(trans('更新出错'));
        });
    }

    public function delete(Model $category)
    {
        if (parent::delete($category)) {
            return true;
        }

        throw new GeneralException('删除出错');
    }
}
