<?php

namespace App\Repositories\Backend\Banners;

use App\Exceptions\GeneralException;
use App\Models\Image;
use DB;
use Storage;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class ImageRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Image::class;

    public function getAll()
    {
        return $this->query()->all();
    }

    public function getForDataTable()
    {
        return $this->query()->select('banner_image.*', 'banners.title as banner_title')
                ->leftJoin('banners', 'banners.id', '=', 'banner_image.banner_id');
    }

    public function getCategoryBanners($id)
    {
        return $this->query()->where('banner_id', $id)->orderBy('order', 'asc')->get();
    }

    public function create($input)
    {
        $image = self::MODEL;
        $image = new $image;
        $imageUrl = $input->image->store('banners');
        $image->banner_id = $input->banner_id;
        $image->title = $input->title;
        $image->image_url = $imageUrl;
        $image->link = $input->link;
        $image->target = $input->target;
        $image->description = $input->description;
        $image->order = $input->order;
        $image->published_from = $input->published_from;
        $image->published_to = $input->published_to;

        DB::transaction(function () use ($image) {
            if ($image->save()) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $image, array $input)
    {
        if (isset($input['new_image'])) {
            $oldImage = $input['image_url'];
            $imageUrl = $input['new_image']->store('banners');
            $image->image_url = $imageUrl;
        }

        DB::transaction(function () use ($image, $input) {
            if (parent::update($image, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });

        //最后删除原图
        if (isset($input['new_image'])) {
            Storage::delete($oldImage);
        }
    }

    public function destroy(Model $image)
    {
        if (parent::delete($image)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $image)
    {
        if (is_null($image->deleted_at)) {
            throw new GeneralException('广告不能恢复！');
        }
        if (parent::restore($image)) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete(Model $image)
    {
        if (is_null($image->deleted_at)) {
            throw new GeneralException('要先删除广告！');
        }
        DB::transaction(function () use ($image) {
            if (parent::forceDelete($image)) {
                return true;
            }
            throw new GeneralException('删除失败！');
        });
    }
}
