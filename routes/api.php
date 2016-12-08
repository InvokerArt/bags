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
        'middleware' => ['api', 'bindings'],
        'limit'      => config('api.rate_limits.access.limits'),
        'expires'    => config('api.rate_limits.access.expires'),
], function ($api) {

    //需要认证权限
    $api->group(['middleware' => 'passport:api'], function ($api) {
        //登录用户信息
        $api->get('users/me', 'AuthController@me');
        $api->get('users/companies', 'AuthController@company');
        //更新个人信息
        $api->patch('users', 'AuthController@update');
        //修改密码
        $api->patch('users/password', 'AuthController@editPassword');
        $api->get('users/join-in', 'AuthController@indexJoinIn');
        $api->get('users/join-out', 'AuthController@indexJoinOut');
        $api->get('users/certification-in', 'AuthController@indexCertificationIn');
        $api->get('users/certification-out', 'AuthController@indexCertificationOut');

        $api->get('companies/jobs', 'CompanyController@job');
        $api->get('companies/products', 'CompanyController@product');
        //评论
        $api->post('news/{id}/comment', 'CommentController@store');
        //加盟和认证
        $api->get('companies/{company}/join-certification', 'CompanyController@joinAndValidate');
        $api->post('companies/{company}/joins', 'CompanyController@joinCompany');
        $api->post('companies/{company}/certifications', 'CompanyController@certificationCompany');
        $api->post('companies', 'CompanyController@store');
        $api->patch('companies', 'CompanyController@update');
        //需求
        $api->resource('demands', 'DemandController', ['except' => ['index', 'create', 'show']]);
        $api->get('users/demands', 'DemandController@indexByUser');
        //供应
        $api->resource('supplies', 'SupplyController', ['except' => ['index', 'create', 'show']]);
        $api->get('users/supplies', 'SupplyController@indexByUser');
        //话题
        $api->resource('topics', 'TopicController', ['except' => ['index', 'create', 'show']]);
        $api->get('users/topics', 'TopicController@indexByUser');
        //话题点赞和取消赞
        $api->post('topics/{topic}/vote', 'TopicController@topicVote');
        //回复
        $api->get('topics/{topic}/replies', 'TopicController@indexTopicsReply');
        $api->post('topics/{topic}/replies', 'TopicController@newReply');
        //回复点赞和取消赞
        $api->post('topics/replies/{reply}/vote', 'TopicController@replyVote');
        //产品
        $api->resource('products', 'ProductController', ['except' => ['create', 'show']]);
        //招聘
        $api->post('companies/jobs', 'CompanyController@jobStore');
        //收藏
        $api->get('favorites/companies/role/{id}', 'FavoriteController@indexForCompanyRole');
        $api->get('favorites/exhibitions/', 'FavoriteController@indexForExhibition');
        $api->get('favorites/news/', 'FavoriteController@indexForNews');
        $api->get('favorites/products/', 'FavoriteController@indexForProduct');
        $api->get('favorites/jobs/', 'FavoriteController@indexForJob');
        $api->get('favorites/topics/', 'FavoriteController@indexForTopic');
        $api->get('favorites/demands/', 'FavoriteController@indexForDemand');
        $api->get('favorites/supplies/', 'FavoriteController@indexForSupply');
        $api->post('topics/{topic}/favorites', 'TopicController@favorite');
        $api->post('companies/{company}/favorites', 'CompanyController@favorite');
        $api->post('jobs/{job}/favorites', 'CompanyController@jobFavorite');
        $api->post('products/{product}/favorites', 'CompanyController@productFavorite');
        $api->post('news/{news}/favorites', 'NewsController@favorite');
        $api->post('exhibitions/{exhibition}/favorites', 'ExhibitionController@favorite');
        $api->post('demands/{demand}/favorites', 'DemandController@favorite');
        $api->post('supplies/{supply}/favorites', 'SupplyController@favorite');
        $api->delete('favorites/{favorite}', 'FavoriteController@destroy');
        //消息
        $api->get('notifications', 'NotificationController@index');
        $api->post('notifications/{id}', 'NotificationController@makeAsRead');
        $api->post('notifications', 'NotificationController@store');
        //反馈
        $api->post('feedbacks', 'FeedbackController@store');
        //加盟审核
        $api->patch('joins/{join}', 'CompanyController@join');
        //认证审核
        $api->patch('certifications/{certification}', 'CompanyController@certification');
    });
    /**
     * 主页
     */
    $api->get('home', 'HomepageController@index');


    /**
     * 地区
     */
    $api->get('areas', 'AreaController@index');
    $api->get('areas/{area}', 'AreaController@show');
    $api->get('childrens/{area}', 'AreaController@children');
    $api->get('provinces', 'AreaController@province');//所有省
    $api->get('citys', 'AreaController@city');//所有市
    $api->get('areass', 'AreaController@area');//所有地区


    /**
     * 新闻
     */
    $api->get('news', 'NewsController@indexByCategories');
    $api->get('news/banner', 'NewsController@banner');
    $api->get('news/categories', 'NewsController@categories');
    $api->get('news/search', 'NewsController@search');
    $api->get('news/{news}', 'NewsController@show');

    /**
     * 展会
     */
    $api->get('exhibitions', 'ExhibitionController@indexByCategories');
    $api->get('exhibitions/banner', 'ExhibitionController@banner');
    $api->get('exhibitions/categories', 'ExhibitionController@categories');
    $api->get('exhibitions/search', 'ExhibitionController@search');
    $api->get('exhibitions/{exhibition}', 'ExhibitionController@show');

    /**
     * 公司
     */
    $api->get('companies/role/{role}', 'CompanyController@index');
    $api->get('companies/banner', 'CompanyController@banner');
    $api->get('companies/categories/{category}', 'CompanyController@categories');
    $api->get('companies/search', 'CompanyController@search');
    $api->get('companies/{company}', 'CompanyController@show');

    /**
     * 需求
     */
    $api->get('demands', 'DemandController@index');
    $api->get('demands/search', 'DemandController@search');
    $api->get('demands/{demand}', 'DemandController@show');

    /**
     * 供应
     */
    $api->get('supplies', 'SupplyController@index');
    $api->get('supplies/search', 'SupplyController@search');
    $api->get('supplies/{supply}', 'SupplyController@show');

    /**
     * 论坛
     */
    $api->get('topics/categories', 'TopicController@categories');
    $api->get('topics/categories/{id}', 'TopicController@index');
    $api->get('topics/{topic}', 'TopicController@show');

    /**
     * 产品
     */
    $api->get('products/search', 'ProductController@search');
    $api->get('products/{product}', 'ProductController@show');

    //常见问题
    $api->get('faqs', 'FaqController@index');
    /**
     * 用户
     */
    $api->post('login', 'AuthController@authenticate');
    $api->post('register', 'AuthController@register');
    $api->get('users', 'AuthController@index');
    //单个用户
    $api->patch('password/reset', 'AuthController@reset');
    //发送验证码
    $api->post('verifycode', 'AuthController@verifyCode');
    //获取用户话题
    $api->get('users/{user}/topics', 'TopicController@indexByUserId');
    //获取用户点赞
    $api->get('users/{id}/votes', 'TopicController@indexByUserVotes');

    //上传图片
    $api->post('upload/avatar', 'UploadController@avatar');
    $api->post('upload/company', 'UploadController@company');
    $api->post('upload/product', 'UploadController@product');
    //单个用户
    $api->get('users/{user}', 'AuthController@userInfo');
});
