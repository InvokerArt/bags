<?php

namespace App\Repositories\Backend\Banners;

use App\Exceptions\GeneralException;
use App\Models\Banner;
use DB;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class BannerRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Banner::class;

    public function getForDataTable()
    {
        return $this->query()->select('*');
    }

    public function create($input)
    {
        $banner = self::MODEL;
        $banner = new $banner;
        $banner->title = $input['title'];
        $banner->description = $input['description'];

        DB::transaction(function () use ($banner) {
            if (parent::save($banner)) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $banner, array $input)
    {
        DB::transaction(function () use ($banner) {
            if (parent::update($banner, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $banner)
    {
        if (parent::delete($banner)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $banner)
    {
        if (is_null($banner->deleted_at)) {
            throw new GeneralException('广告位不能恢复！');
        }
        if (parent::restore($banner)) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete(Model $banner)
    {
        if (is_null($banner->deleted_at)) {
            throw new GeneralException('要先删除广告位！');
        }
        DB::transaction(function () use ($banner) {
            if (parent::forceDelete($banner)) {
                return true;
            }
            throw new GeneralException('删除失败！');
        });
    }
}
