<?php

namespace App\Repositories\Backend\Users;

use App\Models\Users\User;

/**
 * Interface UserInterface
 * @package App\Repositories\User
 */
interface UserInterface
{

    /**
     * 普通用户
     * @param int $status
     * @param bool $trashed
     * @return mixed
     */
    public function getForDataTable();

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
    public function update(User $user, $input);

    /**
     * @param  User $user
     * @return mixed
     */
    public function destroy($id);

    /**
     * @param  User $user
     * @return mixed
     */
    public function delete(User $user);

    /**
     * @param  User $user
     * @return mixed
     */
    public function restore(User $user);

    /**
     * @param  User $user
     * @param  $status
     * @return mixed
     */
    public function mark(User $user, $status);

    public function avatar($input);

    public function apiAvatar($input);
}
