<?php

namespace App\Repositories\Backend\Banners;

use App\Exceptions\GeneralException;
use App\Models\Banner;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class BannerRepository implements BannerInterface
{
    public function getForDataTable()
    {
        return Banner::select('*');
    }

    public function create($input)
    {
        $banner = new Banner;
        $banner->title = $input['title'];
        $banner->description = $input['description'];

        DB::transaction(function () use ($banner) {
            if ($banner->save()) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Banner $banner, $input)
    {
        $banner->title = $input['title'];
        $banner->description = $input['description'];

        DB::transaction(function () use ($banner) {
            if ($banner->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $banner = $this->findOrThrowException($id);

        if ($banner->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $banner = $this->findOrThrowException($id);

        if ($banner->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $banner = $this->findOrThrowException($id);

        if ($banner->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $banner = Banner::withTrashed()->find($id);

        if (!is_null($banner)) {
            return $banner;
        }

        throw new GeneralException('未找到广告位信息');
    }
}
