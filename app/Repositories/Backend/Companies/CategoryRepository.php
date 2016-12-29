<?php

namespace App\Repositories\Backend\Companies;

use App\Models\CategoriesCompanies;
use App\Exceptions\GeneralException;
use App\Helper\Catalog\Image;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = CategoriesCompanies::class;

    public function update(Model $category, array $input)
    {
        if (parent::update($category, $input)) {
            return true;
        }

        throw new GeneralException(trans('更新出错'));
    }

    public function delete(Model $category)
    {
        if (parent::delete($category)) {
            return true;
        }

        throw new GeneralException('删除出错');
    }
}
