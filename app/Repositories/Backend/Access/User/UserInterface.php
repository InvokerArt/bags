<?php

namespace App\Repositories\Backend\Access\User;

use App\Models\Access\User\User;

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

    /**
     * @param  User $user
     * @param  $input
     * @return mixed
     */
    public function updatePassword(User $user, $input);

	/**
     * @param User $user
     * @return mixed
     */
    public function loginAs(User $user);

	/**
     * @return mixed
     */
    public function logoutAs();

	/**
	 * @return mixed
	 */
	public function flushTempSession();
}