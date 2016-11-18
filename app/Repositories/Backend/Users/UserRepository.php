<?php

namespace App\Repositories\Backend\Users;

use App\Exceptions\GeneralException;
use App\Models\Users\User;
use Illuminate\Support\Facades\DB;
use Image;
use URL;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class UserRepository implements UserInterface
{
    /**
     * @var FrontendUserInterface
     */
    protected $user;

    /**
     * @param FrontendUserInterface $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getForDataTable()
    {
        return User::select('*');
        //原生写法
        // return User::leftJoin("role_user", 'role_user.user_id', '=', 'users.id')
        //     ->whereNull('role_user.user_id')
        //     ->get()
        //     ->unique();
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
        $user = User::where('username', $input['username'])->first();
        if ($user) {
            throw new GeneralException("会员用户名已存在！");
        }

        $user = new User;
        $user->username = $input->username;
        $user->mobile = $input->mobile;
        $user->name = $input->name;
        $user->email = $input->email;
        $user->avatar = $input->avatar;
        $user->password = bcrypt($input->password);

        DB::transaction(function () use ($user) {
            if ($user->save()) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    /**
     * @param User $user
     * @param $input
     * @param $roles
     * @return bool
     * @throws GeneralException
     */
    public function update(User $user, $input)
    {
        $user->username = $input->username;
        $user->mobile = $input->mobile;
        $user->name = $input->name;
        $user->email = $input->email;

        if ($input->avatar) {
            $user->avatar = $input->avatar;
        }
        
        if ($input->password) {
            $user->password = bcrypt($input->password);
        }

        DB::transaction(function () use ($user) {
            if ($user->update()) {
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
    public function updatePassword(User $user, $input)
    {
        $user->password = bcrypt($input['password']);

        if ($user->save()) {
            event(new UserPasswordChanged($user));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param  User $user
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {
    }

    /**
     * @param  User $user
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete(User $user)
    {
    }

    /**
     * @param  User $user
     * @throws GeneralException
     * @return bool
     */
    public function restore(User $user)
    {
    }

    /**
     * @param  User $user
     * @param  $status
     * @throws GeneralException
     * @return bool
     */
    public function mark(User $user, $status)
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
            if (User::where('email', '=', $input['email'])->first()) {
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
        $content = $input->getContent();
        $img = Image::make($content);
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
            $largeAvatar = asset(str_replace(public_path(), '', $largePath));
            $mediumAvatar = asset(str_replace(public_path(), '', $mediumPath));
            $smallAvatar = asset(str_replace(public_path(), '', $smallPath));
            $avatarUrl = ['large' => $largeAvatar, 'medium' => $mediumAvatar, 'small' => $smallAvatar];
            return ['avatar' => $avatarUrl];
        }
    }
}
