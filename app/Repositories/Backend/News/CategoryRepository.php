<?php

namespace App\Repositories\Backend\News;

use App\Models\CategoriesNews;
use App\Exceptions\GeneralException;
use App\Helper\Catalog\Image;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class CategoryRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = CategoriesNews::class;

    public function update(Model $category, array $input)
    {
        if (parent::update($category, $input)) {
            return true;
        }

        throw new GeneralException(trans('更新出错'));
    }

    public function delete(Model $category)
    {
        if ($category->delete()) {
            return true;
        }

        throw new GeneralException('删除出错');
    }
}
