<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/**
 * 前端访问控制器
 */
/**
 * 登录退出路由
 */
//Route::group(['middleware' => 'cacheable'], function () {
    Auth::routes();
    //技验验证
    Route::get('ajax/geetest', 'Controller@getGeetest');
    //媒体库
    TalvBansal\MediaManager\Http\Routes::mediaBrowser();

    Route::group(['namespace' => 'Frontend'], function () {
        /**
         * 需要登录页面
         */
        Route::group(['namespace' => 'User', 'middleware' => 'auth'], function () {
            Route::get('/dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        });
        /**
         * 不需要登录页面
         */
        //Route::get('/', 'IndexController@index')->name('frontend.index');
        Route::get('/', function () {
            return view('advertising.app');
        });
    });

    //普通文件上传
    Route::post('upload', 'UploadController@index')->name('upload.index');
    //营业执照和公司照片文件上传
    Route::post('upload/company', 'UploadController@company')->name('upload.company');
    Route::delete('upload/company', 'UploadController@companyDelete')->name('upload.companyDelete');
    //产品上传
    Route::post('upload/product', 'UploadController@product')->name('upload.product');
    Route::delete('upload/product', 'UploadController@productDelete')->name('upload.productDelete');
//});
