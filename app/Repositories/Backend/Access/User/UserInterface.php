<?php

namespace App\Repositories\Backend\Access\User;

use App\Models\Admin;

/**
 * Interface UserInterface
 * @package App\Repositories\User
 */
interface UserInterface
{
    /**
     * @param int $status
     * @param bool $trashed
     * @return mixed
     */
    public function getForDataTable();

    /**
     * 普通用户
     * @param int $status
     * @param bool $trashed
     * @return mixed
     */
    public function getUserForDataTable();

    /**
     * @param $input
     * @param $roles
     * @return mixed
     */
    public function create($input);

    /**
     * @param User $user
     * @param $input
     * @param $roles
     * @return mixed
     */
    public function update($input);

    /**
     * @param  User $user
     * @return mixed
     */
    public function destroy($id);

    /**
     * @param  User $user
     * @return mixed
     */
    public function delete(Admin $user);

    /**
     * @param  User $user
     * @return mixed
     */
    public function restore(Admin $user);

    /**
     * @param  User $user
     * @param  $status
     * @return mixed
     */
    public function mark(Admin $user, $status);

    /**
     * @param  User $user
     * @param  $input
     * @return mixed
     */
    public function updatePassword(Admin $user, $input);

    /**
     * @param User $user
     * @return mixed
     */
    public function loginAs(Admin $user);

    /**
     * @return mixed
     */
    public function logoutAs();

    /**
     * @return mixed
     */
    public function flushTempSession();
}
