<?php

namespace App\Repositories\Backend\Topics;

use App\Models\CategoriesTopics;
use App\Exceptions\GeneralException;
use App\Helper\Catalog\Image;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class CategoryRepository implements CategoryInterface
{
    public function delete($id)
    {

        $category = CategoriesTopics::findOrFail($id);
        if ($category->delete()) {
            return true;
        }

        throw new GeneralException('删除出错');
    }

    public function update($id, $input)
    {
        $category = CategoriesTopics::findOrFail($id);
        if ($category->update($input->except('_token'))) {
            $category->save();
            return true;
        }

        throw new GeneralException(trans('更新出错'));
    }
}
