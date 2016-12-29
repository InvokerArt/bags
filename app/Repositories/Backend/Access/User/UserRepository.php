<?php

namespace App\Repositories\Backend\Access\User;

use App\Exceptions\GeneralException;
use App\Models\Admin;
use App\Repositories\Backend\Access\Role\RoleRepository;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Image;
use URL;

/**
 * Class UserRepository
 * @package App\Repositories\User
 */
class UserRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Admin::class;

    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    /**
     * @param int $status
     * @param bool $trashed
     * @return mixed
     */
    public function getForDataTable($trashed = false)
    {
        $dataTableQuery = $this->query()
            ->has('roles', '>', 0)
            ->select([
                config('access.users_table') . '.id',
                config('access.users_table') . '.username',
                config('access.users_table') . '.name',
                config('access.users_table') . '.email',
                config('access.users_table') . '.created_at',
                config('access.users_table') . '.updated_at',
                config('access.users_table') . '.deleted_at',
            ]);

        if ($trashed == "true") {
            return $dataTableQuery->onlyTrashed();
        }

        return $dataTableQuery;
    }

    /**
     * 获取普通用户
     * @param int $status
     * @param bool $trashed
     * @return mixed
     */
    public function getUserForDataTable()
    {
        $dataTableQuery = $this->query()
            ->has('roles', 0)
            ->select([
                config('access.users_table') . '.id',
                config('access.users_table') . '.username',
                config('access.users_table') . '.name',
                config('access.users_table') . '.email',
                config('access.users_table') . '.created_at',
                config('access.users_table') . '.updated_at',
                config('access.users_table') . '.deleted_at',
            ]);

        if ($trashed == "true") {
            return $dataTableQuery->onlyTrashed();
        }

        return $dataTableQuery;
    }

    /**
     * 创建管理员
     *
     * @param  array $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        $user = Admin::find($input['user_id']);

        if (!$user) {
            throw new GeneralException('用户不存在！');
        }

        if ($user->id == 1) {
            throw new GeneralException('创始人不允许更改！');
        }

        $all = $input['role_user'] == 'all' ? true : false;

        if (! isset($input['roles'])) {
            $input['roles'] = [];
        }

        $roles = [];
        if (! $all) {
            $this->checkUserRolesCount($input['roles']);
            if (is_array($input['roles']) && count($input['roles'])) {
                foreach ($input['roles'] as $role) {
                    if (is_numeric($role)) {
                        array_push($roles, $role);
                    }
                }
            }
        } else {
            $roles[] = 2;
        }

        DB::transaction(function () use ($user, $roles) {
            try {
                $user->attachRoles($roles);
                return true;
            } catch (\Exception $e) {
                throw new GeneralException('管理员创建失败！');
            }
        });
    }

    /**
     * 更新管理员
     *
     * @param  Model  $user
     * @param  array  $input
     * @throws GeneralException
     * @return bool
     */
    public function update(Model $user, array $input)
    {
        $user = Admin::find($input['user_id']);

        if (!$user) {
            throw new GeneralException('用户不存在！');
        }

        if ($user->id == 1) {
            throw new GeneralException('创始人不允许更改！');
        }

        $all = $input['role_user'] == 'all' ? true : false;

        if (! isset($input['roles'])) {
            $input['roles'] = [];
        }

        $roles = [];
        if (! $all) {
            $this->checkUserRolesCount($input['roles']);
            if (is_array($input['roles']) && count($input['roles'])) {
                foreach ($input['roles'] as $role) {
                    if (is_numeric($role)) {
                        array_push($roles, $role);
                    }
                }
            }
        } else {
            $roles[] = 2;
        }

        DB::transaction(function () use ($user, $roles) {
            try {
                $this->flushRoles($roles, $user);
                return true;
            } catch (\Exception $e) {
                throw new GeneralException('管理员编辑失败！');
            }
        });
    }

    /**
     * @param  Admin $user
     * @throws GeneralException
     * @return bool
     */
    public function destroy(Model $user)
    {
        //Would be stupid to delete the administrator role
        if ($user->id == 1) { //id is 1 because of the seeder
            throw new GeneralException('创始人不允许删除！');
        }

        if (access()->id() == $user->id) {
            throw new GeneralException('不能删除自己！');
        }

        $user->detachRoles($user->roles);
        return true;
    }

    /**
     * @param $roles
     * @param $user
     */
    private function flushRoles($roles, $user)
    {
        //Flush roles out, then add array of new ones
        $user->detachRoles($user->roles);
        $user->attachRoles($roles);
    }

    /**
     * @param  $roles
     * @throws GeneralException
     */
    private function checkUserRolesCount($roles)
    {
        if (config('access.users.user_must_contain_role') && count($roles) == 0) {
            throw new GeneralException('您必须为管理员至少选择一个角色！');
        }
    }
}
