<?php

namespace App\Repositories\Backend\Access\Permission;

use App\Models\Permission;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionRepository
 * @package App\Repositories\Permission
 */
class PermissionRepository extends Repository
{
    /**
     * 关联关系模型
     */
    const MODEL = Permission::class;

    /**
     * 取Datatable数据
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.permissions_table') . '.id',
                config('access.permissions_table') . '.name',
                config('access.permissions_table') . '.display_name',
                config('access.permissions_table') . '.description'
            ]);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * 创建权限
     *
     * @param  $input
     * @throws Exception
     * @return bool
     */
    public function create($input)
    {
        if (Permission::where('name', $input['name'])->first()) {
            throw new GeneralException('权限名称已存在！');
        }

        DB::transaction(function () use ($input) {
            $permission = self::MODEL;
            $permission = new $permission;
            $permission->name = $input['name'];
            $permission->display_name = $input['display_name'];
            $permission->description = $input['description'];

            if (parent::save($permission)) {
                return true;
            }

            throw new GeneralException('权限创建失败！');
        });
    }

    /**
     * 更新权限
     *
     * @param  Permission $permission [description]
     * @param  $input
     * @throws Exception
     * @return bool
     */
    public function update(Model $permission, array $input)
    {
        if ($permission->id < 4) {
            throw new GeneralException('不能更改系统默认权限！');
        }

        $permission->name = $input['name'];
        $permission->display_name = $input['display_name'];
        $permission->description = $input['description'];
        
        DB::transaction(function () use ($permission) {

            if (parent::save($permission)) {
                return true;
            }

            throw new GeneralException('权限更新失败！');
        });
    }

    /**
     * 删除权限
     *
     * @param  Permission $permission
     * @throws Exception
     * @return bool
     */
    public function destroy(Model $permission)
    {
        if ($permission->id < 4) {
            throw new GeneralException('不能删除系统默认权限！');
        }

        DB::transaction(function () use ($permission) {

            if ($permission->delete()) {
                return true;
            }

            throw new GeneralException('权限删除失败！');
        });
    }
}
