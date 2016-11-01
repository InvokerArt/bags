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
        'middleware' => ['api.throttle', 'bindings'],
        'limit'      => config('api.rate_limits.access.limits'),
        'expires'    => config('api.rate_limits.access.expires'),
], function ($api) {
    //用户
    $api->post('login', 'AuthController@authenticate');
    $api->post('register', 'AuthController@register');
    $api->put('password/reset', 'AuthController@reset');
    //发送验证码
    $api->post('verifycode', 'AuthController@verifyCode');
    //地区
    $api->get('areas', 'AreaController@index');
    $api->get('areas/{area}', 'AreaController@show');


    /**
     * 新闻
     */
    $api->get('news', 'NewsController@index');
    $api->get('news/banner', 'NewsController@banner');
    $api->get('news/categories', 'NewsController@categories');
    $api->get('news/{news}', 'NewsController@show');

    /**
     * 展会
     */
    $api->get('exhibitions', 'ExhibitionController@index');
    $api->get('exhibitions/banner', 'ExhibitionController@banner');
    $api->get('exhibitions/categories', 'ExhibitionController@categories');
    $api->get('exhibitions/{exhibition}', 'ExhibitionController@show');

    /**
     * 公司
     */
    $api->get('companies/role/{role}', 'CompanyController@index');
    $api->get('companies/banner', 'CompanyController@banner');
    $api->get('companies/categories/{category}', 'CompanyController@categories');
    $api->get('companies/{company}', 'CompanyController@show');
    $api->get('companies/{company}/jobs', 'CompanyController@job');
    $api->get('companies/{company}/products', 'CompanyController@product');

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
