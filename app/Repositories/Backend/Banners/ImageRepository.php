<?php

namespace App\Repositories\Backend\Banners;

use App\Exceptions\GeneralException;
use App\Models\Banners\Image;
use DB;
use Storage;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class ImageRepository implements ImageInterface
{
    public function getAll()
    {
        return Image::all();
    }

    public function getForDataTable()
    {
        return Image::select('banner_image.*', 'banners.title as banner_title')
                ->leftJoin('banners', 'banners.id', '=', 'banner_image.banner_id');
    }

    public function create($input)
    {
        $image = new Image;
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

    public function update(Image $image, $input)
    {
        if ($input->new_image) {
            $oldImage = $input->image_url;
            $imageUrl = $input->new_image->store('banners');
            $image->image_url = $imageUrl;
        }
        $image->banner_id = $input->banner_id;
        $image->title = $input->title;
        $image->link = $input->link;
        $image->target = $input->target;
        $image->description = $input->description;
        $image->order = $input->order;
        $image->published_from = $input->published_from;
        $image->published_to = $input->published_to;

        DB::transaction(function () use ($image) {
            if ($image->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });

        //最后删除原图
        if ($input->new_image) {
            Storage::delete($oldImage);
        }
    }

    public function destroy($id)
    {
        $image = $this->findOrThrowException($id);

        if ($image->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $image = $this->findOrThrowException($id);

        if ($image->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $image = $this->findOrThrowException($id);

        if ($image->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $image = Image::withTrashed()->find($id);

        if (!is_null($image)) {
            return $image;
        }

        throw new GeneralException('未找到广告信息');
    }
}
