<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = Api::router();

$api->version('v1', ['namespace' => 'App\Api\V1\Controllers',
        'middleware' => 'api.throttle',
        'limit'      => config('api.rate_limits.access.limits'),
        'expires'    => config('api.rate_limits.access.expires'),
], function ($api) {
    //用户
    $api->post('login', 'AuthController@authenticate');
    $api->post('register', 'AuthController@register');
    $api->put('password/reset', 'AuthController@reset');
    //发送验证码
    $api->post('verifycode', 'AuthController@verifyCode');
    //获取所有用户
    $api->get('users', 'AuthController@users');
    //新闻
    $api->get('news', 'NewsController@index');
    //收藏
    $api->resource('/favorites', 'FavoriteController', ['except' => 'index']);
    $api->get('test', 'TestController@index');
    //需要认证权限
    $api->group(['middleware' => 'passport:api'], function ($api) {
        //登录用户信息
        $api->get('user', 'AuthController@userme');
        //更新个人信息
        $api->patch('user', 'AuthController@update');
        //修改密码
        $api->put('user/password', 'AuthController@editPassword');
        //评论
        $api->post('news/{id}/comment', 'CommentController@store');
    });
});
