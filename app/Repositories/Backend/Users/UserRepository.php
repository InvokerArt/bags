<?php

namespace App\Repositories\Backend\Users;

use App\Events\UserDeleted;
use App\Events\UserPermanentlyDeleted;
use App\Exceptions\GeneralException;
use App\Models\User;
use App\Repositories\Repository;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Image;
use URL;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class UserRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = User::class;

    /**
     * @var FrontendUserRepository
     */

    public function getForDataTable()
    {
        return $this->query()->select('*');
    }

    /**
     * @param  $input
     * @param  $roles
     * @throws GeneralException
     * @throws UserNeedsRolesException
     * @return bool
     */
    public function create($input)
    {
        if (isset($input->username)) {
            $user = $this->query()->where('username', $input->username)->first();
            if ($user) {
                throw new GeneralException("会员用户名已存在！");
            }
        }

        $user = self::MODEL;
        $user = new $user;
        $user->username = isset($input->username) ? $input->username : '';
        $user->mobile = $input->mobile;
        $user->name = isset($input->name) ? $input->name : '';
        $user->email = isset($input->email) ? $input->email : '';
        $user->avatar = isset($input->avatar) ? $input->avatar : '';
        $user->password = bcrypt($input->password);

        DB::transaction(function () use ($user) {
            if (parent::save($user)) {
                return $user;
            }

            throw new GeneralException("添加失败");
        });
        return $user;
    }

    /**
     * @param User $user
     * @param $input
     * @param $roles
     * @return bool
     * @throws GeneralException
     */
    public function update(Model $user, array $input)
    {

        if (isset($input['avatar'])) {
            $user->avatar = $input['avatar'];
        }
        
        if (isset($input['password'])) {
            $user->password = bcrypt($input['password']);
        }

        DB::transaction(function () use ($user, $input) {
            if (parent::update($user, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    /**
     * @param  User $user
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function resetPassword($input)
    {
        $user = User::where('mobile', $input->mobile)->first();
        if (!$user) {
            throw new GeneralException('用户不存在！');
        }

        $user->password = bcrypt($input->password);

        DB::transaction(function () use ($user) {
            if (parent::save($user)) {
                return $user;
            }
            throw new GeneralException('密码修改失败。');
        });
        return $user;
    }

    /**
     * @param  User $user
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function updatePassword(Model $user, $input)
    {
        if (Hash::check($input->old_password, $user->password)) {
            $user->password = bcrypt($input->password);
        } else {
            throw new GeneralException('密码错误');
        }

        if (parent::save($user)) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param  User $user
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

        if (count($user->roles) > 0) {
            throw new GeneralException('删除失败，你要先删除会员的管理权限才能执行删除会员操作！');
        }

        if (parent::delete($user)) {
            event(new UserDeleted($user));
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    /**
     * @param  User $user
     * @throws GeneralException
     * @return bool
     */
    public function restore(Model $user)
    {
        //Failsafe
        if (is_null($user->deleted_at)) {
            throw new GeneralException("此用户没有被删除，因此无法恢复。");
        }

        if ($user->restore()) {
            return true;
        }

        throw new GeneralException('返回失败！');
    }

    /**
     * @param  User $user
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete(Model $user)
    {
        //Failsafe
        if (is_null($user->deleted_at)) {
            throw new GeneralException('必须先删除此用户，然后才能永久销毁此用户。');
        }

        DB::transaction(function () use ($user) {
            if (parent::forceDelete($user)) {
                event(new UserPermanentlyDeleted($user));
                return true;
            }
            throw new GeneralException('删除失败！');
        });
    }

    /**
     * @param  User $user
     * @param  $status
     * @throws GeneralException
     * @return bool
     */
    public function mark(Model $user, $status)
    {
        if (access()->id() == $user->id && $status == 0) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_deactivate_self'));
        }

        $user->status = $status;

        //Log history dependent on status
        switch ($status) {
            case 0:
                event(new UserDeactivated($user));
                break;

            case 1:
                event(new UserReactivated($user));
                break;
        }

        if ($user->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.mark_error'));
    }

    /**
     * @param  $input
     * @param  $user
     * @throws GeneralException
     */
    private function checkUserByEmail($input, $user)
    {
        //Figure out if email is not the same
        if ($user->email != $input['email']) {
            //Check to see if email exists
            if ($this->query()->where('email', '=', $input['email'])->first()) {
                throw new GeneralException(trans('exceptions.backend.access.users.email_error'));
            }
        }
    }

    public function avatar($input)
    {
        $file = $input['avatar_file'];
        $avatarData = $input['avatar_data'];
        if ($file->isValid()) {
            $type = $file->getMimeType();
            if ($type) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                if ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') {
                    $newName = '/'.date('YmdHis');
                    $baseFile = public_path(config('avatar.upload')).$newName.".".$extension;
                    $result = $file->move(public_path(config('avatar.upload')), $baseFile);
                    if ($result) {
                        $img = Image::make($baseFile);
                        $img->backup();
                        $data = json_decode(stripslashes($avatarData));
                        if ($data) {
                            if ($data->rotate) {
                                $img->rotate(-($data->rotate));
                            }
                            $img->crop((int)$data->width, (int)$data->height, (int)$data->x, (int)$data->y);
                        }
                        $img->save();
                        //大图
                        $large = config('avatar.large.size');
                        $img->resize($large, $large);
                        $img->save(public_path(config('avatar.upload')).$newName."_".$large."x".$large.".".$extension);
                        //中图
                        $medium = config('avatar.medium.size');
                        $img->resize($medium, $medium);
                        $img->save(public_path(config('avatar.upload')).$newName."_".$medium."x".$medium.".".$extension);
                        //小图
                        $small = config('avatar.small.size');
                        $img->resize($small, $small);
                        $img->save(public_path(config('avatar.upload')).$newName."_".$small."x".$small.".".$extension);
                        $avatar = str_replace(public_path(), '', $baseFile);
                        $avatarUrl = URL::asset($avatar);
                        $state = 200;
                        $msg = '上传成功！';
                    } else {
                        $state = 400;
                        $msg = '上传失败！';
                    }
                } else {
                    $state = 400;
                    $msg = '允许上传的图片格式为JPG, PNG, GIF';
                }
            } else {
                $state = 400;
                $msg = '请上传图片';
            }
        } else {
            $state = 599;
            $msg = $file->getErrorMessage();
        }

        $response = array(
            'state' => $state,
            'message' => $msg,
            'url' => $avatarUrl ? $avatarUrl : null,
            'avatar' => $avatar ? $avatar : null
        );

        return $response;
    }

    public function apiAvatar($input)
    {
        $avatarUrl = '';
        $image = $input->file('images');
        $img = Image::make($image->getRealPath());
        $newName = '/'.date('YmdHis');
        $baseFile = public_path(config('avatar.upload')).$newName.".png";
        $result = $img->save($baseFile);
        if ($result) {
            $img->backup();
            $img->save();
            //大图
            $large = config('avatar.large.size');
            $img->resize($large, $large);
            $largePath = public_path(config('avatar.upload')).$newName."_".$large."x".$large.".png";
            $img->save($largePath);
            //中图
            $medium = config('avatar.medium.size');
            $img->resize($medium, $medium);
            $mediumPath = public_path(config('avatar.upload')).$newName."_".$medium."x".$medium.".png";
            $img->save($mediumPath);
            //小图
            $small = config('avatar.small.size');
            $img->resize($small, $small);
            $smallPath = public_path(config('avatar.upload')).$newName."_".$small."x".$small.".png";
            $img->save($smallPath);
            $default= asset(str_replace(public_path(), '', $baseFile));
            $largeAvatar = asset(str_replace(public_path(), '', $largePath));
            $mediumAvatar = asset(str_replace(public_path(), '', $mediumPath));
            $smallAvatar = asset(str_replace(public_path(), '', $smallPath));
            $avatarUrl = ['_default' => $default, 'large' => $largeAvatar, 'medium' => $mediumAvatar, 'small' => $smallAvatar];
            return ['avatar' => $avatarUrl];
        }
    }

    public function userInfoByMobile($input)
    {
        return $this->query()->where('mobile', $input->mobile)->firstOrFail();
    }
}
