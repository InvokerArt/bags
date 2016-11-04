<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\UserPasswordRequest;
use App\Api\V1\Requests\UserRequest;
use App\Api\V1\Requests\UserResetRequest;
use App\Api\V1\Requests\UserStoreRequest;
use App\Api\V1\Requests\UserUpdateRequest;
use App\Api\V1\Transformers\UserTransformer;
use App\Models\Users\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use SmsManager;

class AuthController extends BaseController
{
    /**
     * @apiDefine Auth 用户
     */

    /**
     * @api {post} /login 登录
     * @apiDescription 登录
     * @apiGroup Auth
     * @apiPermission 无
     * @apiParam {Number} mobile     手机
     * @apiParam {String} password  密码
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *      {
     *          "token_type": "Bearer",
     *          "expires_in": 3155673600,
     *          "access_token": "eyJ0eXAiOiJKV1Qi",
     *          "refresh_token": "SYtfODuI03lgKyh"
     *      }
     * @apiSampleRequest /api/login
     */
    public function authenticate(UserRequest $request)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', env('APP_URL').'oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => env('API_CLIENT_ID'),
                'client_secret' => env('API_CLIENT_SECRET'),
                'username' => $request->mobile,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return $this->response->array(json_decode((string) $response->getBody(), true));
    }

    /**
     * @api {post} /register 注册
     * @apiDescription 注册
     * @apiGroup Auth
     * @apiPermission 无
     * @apiParam {Number} mobile     手机
     * @apiParam {Number} verifyCode     验证码
     * @apiParam {String} password  密码
     * @apiParam {String} password_confirmation  密码
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     *      {
     *          "mobile": "xxxxxxxxxx",
     *          "updated_at": "2016-10-14 13:28:36",
     *          "created_at": "2016-10-14 13:28:36",
     *          "id": 3
     *      }
     */
    public function register(UserStoreRequest $request)
    {
        $user = new User;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);

        try {
            // 创建用户成功
            $user->save();
            return $this->response->created(env('APP_URL').'api/login/', $user);
        } catch (\Exception $e) {
            return $this->response->errorBadRequest($e->getMessage());
        }
    }

    /**
     * @api {PATCH} /password/reset 忘记密码
     * @apiDescription 忘记密码
     * @apiGroup Auth
     * @apiPermission 无
     * @apiParam {Number} mobile     手机
     * @apiParam {Number} verifyCode  验证码
     * @apiParam {String} password  新密码
     * @apiParam {String} password_confirmation  确认新密码
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No Content
     */
    public function reset(UserResetRequest $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
        if ($user) {
            try {
                $user->password = bcrypt($request->password);
                $user->save();
                return $this->response->noContent();
            } catch (\Exception $e) {
                return $this->response->errorBadRequest($e->getMessage());
            }
        } else {
            return $this->resource->errorNotFound('用户不存在！');
        }
    }

    public function update(UserUpdateRequest $request)
    {
        $user = Auth::user();
    }

    /**
     * @api {PATCH} /users/password 修改密码
     * @apiDescription 修改密码
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiParam {String} old_password  旧密码
     * @apiParam {String} password  新密码
     * @apiParam {String} password_confirmation  确认新密码
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No Content
     */
    public function editPassword(UserPasswordRequest $request)
    {
        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = bcrypt($request->password);
            try {
                $user->save();
                return $this->response->noContent();
            } catch (\Exception $e) {
                return $this->response->errorBadRequest($e->getMessage());
            }
        } else {
            return $this->response->errorForbidden('密码错误');
        }
    }

    /**
     * @api {post} /verifycode 发送验证码
     * @apiDescription 发送验证码
     * @apiGroup Auth
     * @apiPermission 无
     * @apiParam {String} mobile_rule  验证方式(默认值check_mobile_unique)
     * @apiParam {Number} mobile     手机
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *      {
     *          "success": true,
     *          "type": "sms_sent_success",
     *          "message": "短信验证码发送成功，请注意查收"
     *      }
     *
     * @apiErrorExample {json} Error-Response:
     *      HTTP/1.1 400 OK
     *      {
     *          "message": "发送过快！"
     *      }
     */
    public function verifycode()
    {
        $res = SmsManager::validateSendable();
        if (!$res['success']) {
            return $this->response->error($res['message'], 400);
        }

        $res = SmsManager::validateFields();
        if (!$res['success']) {
            return $this->response->error($res['message'], 400);
        }

        $res = SmsManager::requestVerifySms();

        return $this->response->array($res);
    }

    //刷新token
    public function refreshToken(Request $request)
    {
        $response = $client->request('POST', env('APP_URL').'oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->refresh_token,
                'client_id' => env('API_CLIENT_ID'),
                'client_secret' => env('API_CLIENT_SECRET'),
            ],
        ]);

        return $this->response->array(json_decode((string) $response->getBody(), true));
    }

    public function index()
    {
        $users = User::WithoutBanned()->paginate();
        return $this->response->paginator($users, new UserTransformer());
    }

    /**
     * @api {post} /users/:id 单个用户信息
     * @apiDescription 单个用户信息
     * @apiGroup Auth
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "id": 1,
            "username": "admin",
            "mobile": "13111111111",
            "email": "admin@admin.com",
            "avatar": "http://stone.dev/uploads/avatars/default/medium.png",
            "created_at": "2016-11-02 15:57:24"
        }
    }
     */
    public function userInfo(User $user)
    {
        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @api {get} /users 当前用户信息
     * @apiDescription 当前用户信息
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "id": 1,
            "username": "admin",
            "mobile": "13111111111",
            "email": "admin@admin.com",
            "avatar": "http://stone.dev/uploads/avatars/default/medium.png",
            "created_at": "2016-11-02 15:57:24",
        }
    }
     */
    public function me(Request $request)
    {
        $user = Auth::user();
        return $this->response->item($user, new UserTransformer());
    }
}
