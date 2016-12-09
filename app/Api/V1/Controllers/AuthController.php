<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\UserPasswordRequest;
use App\Api\V1\Requests\UserRequest;
use App\Api\V1\Requests\UserResetRequest;
use App\Api\V1\Requests\UserStoreRequest;
use App\Api\V1\Requests\UserUpdateRequest;
use App\Api\V1\Transformers\AuthenticateTransformer;
use App\Api\V1\Transformers\AuthorizationTransformer;
use App\Api\V1\Transformers\CertificationTransformer;
use App\Api\V1\Transformers\CompanyTransformer;
use App\Api\V1\Transformers\JoinTransformer;
use App\Api\V1\Transformers\UserTransformer;
use App\Events\UserCreateEvent;
use App\Models\Certification;
use App\Models\Join;
use App\Models\User;
use App\Repositories\Backend\Users\UserInterface;
use Auth;
use GuzzleHttp\Exception\RequestException;
use Hash;
use Illuminate\Http\Request;
use SmsManager;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthController extends BaseController
{
    protected $users;

    public function __construct(UserInterface $users)
    {
        $this->users = $users;
    }

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
                "user": {
                    "id": 16,
                    "username": "username8",
                    "mobile": "15960838225",
                    "email": {
                        "_default": "",
                        "small": "",
                        "medium": "",
                        "large": ""
                    },
                    "avatar": "http://stone.dev/uploads/avatars/default/medium.png",
                    "created_at": "2016-11-07 07:49:28"
                }
     *      }
     * @apiSampleRequest /api/login
     */
    public function authenticate(UserRequest $request)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', env('APP_URL').'/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('API_CLIENT_ID'),
                    'client_secret' => env('API_CLIENT_SECRET'),
                    'username' => $request->mobile,
                    'password' => $request->password,
                    'scope' => '',
                ],
            ]);
            $data['data'] = json_decode((string) $response->getBody(), true);
            $user = User::where('mobile', $request->mobile)->first();
            $userTransformer = new UserTransformer();
            $data['data']['user'] = $userTransformer->transform($user);
            return $this->response->array($data);
        } catch (RequestException $e) {
            throw new UnauthorizedHttpException('Unauthenticated.', '认证失败');
        }
    }

    /**
     * @api {post} /register 注册
     * @apiDescription 注册
     * @apiGroup Auth
     * @apiPermission 无
     * @apiParam {Number} mobile     手机
     * @apiParam {Number} verifyCode     验证码
     * @apiParam {String} password  密码
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     */
    public function register(UserStoreRequest $request)
    {
        $user = new User;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        try {
            // 创建用户成功
            $user->save();
            $user->password = $request->password;
            event(new UserCreateEvent($user));
            return $this->response->created();
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

    /**
     * @api {PATCH} /users 更新用户信息
     * @apiDescription 更新用户信息
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String} avatar  头像
     * @apiParam {String} username  用户名
     * @apiParam {String} name  真实姓名
     * @apiParam {Number} mobile  电话
     * @apiParam {String} email  邮箱
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "id": 3,
            "username": "test",
            "mobile": "13111111111",
            "email": "test@test.com",
            "avatar": "http://stone.dev/uploads/avatars/20161107085531.png",
            "created_at": "2016-11-02 15:57:24"
        }
    }
     */
    public function update(UserUpdateRequest $request)
    {
        $user = Auth::user();
        $request->avatar = str_replace(env('APP_URL'), '', $request->avatar);
        $this->users->update($user, $request);
        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @api {PATCH} /users/password 修改密码
     * @apiDescription 修改密码
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiParam {String} old_password  旧密码
     * @apiParam {String} password  新密码
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
     * @apiParam {String} mobile_rule  验证方式(注册check_mobile_unique  忘记密码check_mobile_exists)
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
        $response = $client->request('POST', env('APP_URL').'/oauth/token', [
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
        $users = User::withOutBanned()->orderBy('created_at', 'DESC')->paginate();
        return $this->response->paginator($users, new UserTransformer());
    }

    /**
     * @api {get} /users/:id 获取用户信息
     * @apiDescription 获取单个用户信息
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
     * @api {get} /users/me 当前用户信息
     * @apiDescription 当前用户信息
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "user": {
                "id": 2,
                "username": "user",
                "name": "name",
                "mobile": "13113113111",
                "email": "user@user.com",
                "avatar": "http://stone.dev/uploads/avatars/default/medium.png",
                "created_at": "2016-11-02 15:57:24"
            },
            "company": {
                "id": 3,
                "name": "测试公司",
                "province": "北京市",
                "city": "北京市",
                "area": "石景山区",
                "addressDetail": "",
                "telephone": "0592-5928529",
                "role": "1",
                "photos": "http://stone.dev/storage/companies/2016/11/192330UhMQ.png",
                "is_validate": 0,
                "is_excellent": 0
            }
        }
    }
     * @apiSampleRequest /api/users/me
     */
    public function me(Request $request)
    {
        $user = Auth::user();
        $user = json_decode($this->response->item($user, new UserTransformer())->morph()->content(), true);
        $data['data']['user'] = $user['data'];
        $company = Auth::user()->company()->first();
        $company = json_decode($this->response->item($company, new CompanyTransformer())->morph()->content(), true);
        $data['data']['company'] = $company['data'] ? $company['data'] : (object)null;
        return $this->response->array($data);
    }

    /**
     * @api {get} /users/companies 当前用户公司信息
     * @apiDescription 当前用户公司信息
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "id": 3,
            "name": "测试公司",
            "province": "北京市",
            "city": "北京市",
            "area": "石景山区",
            "addressDetail": "",
            "telephone": "0592-5928529",
            "role": "1",
            "photos": [
                "/storage/companies/2016/11/192330UhMQ.png"
            ],
            "is_validate": 0,
            "is_excellent": 0
        }
    }
     * @apiSampleRequest /api/users/companies
     */
    public function company(Request $request)
    {
        $company = Auth::user()->company()->first();
        return $this->response->item($company, new CompanyTransformer());
    }

    /**
     * @api {get} /users/join-in 我收到的加盟
     * @apiDescription 我收到的加盟
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 15,
                "status": 2,
                "company": {
                    "data": {
                        "id": 3,
                        "name": "测试公司",
                        "province": "北京市",
                        "city": "北京市",
                        "area": "石景山区",
                        "addressDetail": "",
                        "telephone": "0592-5928529",
                        "photos": [
                            "/storage/companies/2016/11/192330UhMQ.png"
                        ],
                        "is_validate": 0,
                        "is_excellent": 0
                    }
                }
            }
        ],
        "meta": {
            "pagination": {
                "total": 1,
                "count": 1,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
     * @apiSampleRequest /api/users/join-in
     */
    public function indexJoinIn()
    {
        $joins = Join::whereHas('company', function ($query) {
            $query->where('user_id', Auth::id());
        })->orderBy('created_at', 'DESC')->paginate();
        return $this->response->paginator($joins, new JoinTransformer());
    }

    /**
     * @api {get} /users/join-out 我申请的加盟
     * @apiDescription 我申请的加盟
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 15,
                "status": 2,
                "company": {
                    "data": {
                        "id": 1,
                        "name": "航运城",
                        "province": "福建省",
                        "city": "厦门市",
                        "area": "思明区",
                        "addressDetail": "软件园二期24号之二306B",
                        "telephone": "0592-5928529",
                        "photos": [
                            "/storage/companies/2016/11/192246tXXv.png",
                            "/storage/companies/2016/11/192247z703.png"
                        ],
                        "is_validate": 0,
                        "is_excellent": 0
                    }
                }
            }
        ],
        "meta": {
            "pagination": {
                "total": 1,
                "count": 1,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
     * @apiSampleRequest /api/users/join-out
     */
    public function indexJoinOut()
    {
        $joins = Join::where('user_id', Auth::id())->with('company')->orderBy('created_at', 'DESC')->paginate();
        return $this->response->paginator($joins, new JoinTransformer());
    }

    /**
     * @api {get} /users/certification-in 我收到的认证
     * @apiDescription 我收到的认证
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK

     * @apiSampleRequest /api/users/certification-in
     */
    public function indexCertificationIn()
    {
        $certifications = Certification::whereHas('company', function ($query) {
            $query->where('user_id', Auth::id());
        })->orderBy('created_at', 'DESC')->paginate();
        return $this->response->paginator($certifications, new CertificationTransformer());
    }

    /**
     * @api {get} /users/certification-out 我申请的认证
     * @apiDescription 我申请的认证
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK

     * @apiSampleRequest /api/users/certification-out
     */
    public function indexCertificationOut()
    {
        $certifications = Certification::where('user_id', Auth::id())->with('company')->orderBy('created_at', 'DESC')->paginate();
        return $this->response->paginator($certifications, new CertificationTransformer());
    }

    public function test()
    {
        return $this->response->created();
    }
}
