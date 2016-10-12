<?php

/**
 * Backend 路由
 * Namespaces indicate folder structure
 * Admin middleware groups web, auth, and routeNeedsPermission
 *
 * 项目注意事项
 * "talvbansal/media-manager": "^1.0","stevenyangecho/laravel-u-editor": "^1.3" 根据自己项目有做修改
 */
Route::group(['namespace' => 'Backend', 'as' => env('APP_BACKEND_PREFIX').'.'], function () {
    Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });
});

Route::group(['namespace' => 'Backend', 'as' => env('APP_BACKEND_PREFIX').'.', 'middleware' => 'admin'], function () {
    /**
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    Route::group(['namespace' => 'Access', 'as' => 'access.', 'prefix' => 'access'], function () {
        //用户
        Route::get('/user/get', 'UserController@get')->name('user.get');
        Route::resource('/user', 'UserController');
        //管理员
        Route::get('/admin/get', 'AdminController@get')->name('admin.get');
        Route::resource('/admin', 'AdminController');
        //角色
        Route::get('/role/get', 'RoleController@get')->name('role.get');
        Route::resource('/role', 'RoleController');
        //权限
        Route::get('/permission/get', 'PermissionController@get')->name('permission.get');
        Route::resource('/permission', 'PermissionController');
    });

    Route::group(['namespace' => 'News', 'as' => 'news.', 'prefix' => 'news'], function () {
        //新闻分类
        Route::resource('categories', 'CategoryController', ['except' => 'show']);
        Route::get('categories/children', 'CategoryController@children')->name('categories.children');
        Route::post('categories/move', 'CategoryController@move')->name('categories.move');
        Route::post('categories/copy', 'CategoryController@copy')->name('categories.copy');
        Route::post('categories/rename', 'CategoryController@rename')->name('categories.rename');
        //新闻
        Route::get('/get', 'NewsController@get')->name('get');
        Route::post('/', 'NewsController@store')->name('store');
        Route::get('/', 'NewsController@index')->name('index');
        Route::get('/create', 'NewsController@create')->name('create');
        Route::match(['put', 'patch'], '/{news}', 'NewsController@update')->name('update');
        Route::delete('/{news}', 'NewsController@destroy')->name('destroy');
        Route::get('/{news}', 'NewsController@show')->name('show');
        Route::get('/{news}/edit', 'NewsController@edit')->name('edit');
    });

    //标签
    Route::group(['namespace' => 'Tags', 'as' => 'tags.', 'prefix' => 'tags'], function () {
        Route::get('/get', 'IndexController@get')->name('get');
        Route::get('/popular', 'IndexController@popular')->name('popular');
        Route::post('/', 'IndexController@store')->name('store');
        Route::get('/', 'IndexController@index')->name('index');
        Route::get('/create', 'IndexController@create')->name('create');
        Route::match(['put', 'patch'], '/{tag}', 'IndexController@update')->name('update');
        Route::delete('/{tag}', 'IndexController@destroy')->name('destroy');
        Route::get('/{tag}', 'IndexController@show')->name('show');
        Route::get('/{tag}/edit', 'IndexController@edit')->name('edit');
    });

    //评论
    Route::group(['namespace' => 'Comments', 'as' => 'comments.', 'prefix' => 'comments'], function () {
        Route::get('/get', 'CommentController@get')->name('get');
        Route::post('/', 'CommentController@store')->name('store');
        Route::get('/', 'CommentController@index')->name('index');
        Route::get('/create', 'CommentController@create')->name('create');
        Route::match(['put', 'patch'], '/{comment}', 'CommentController@update')->name('update');
        Route::delete('/{comment}', 'CommentController@destroy')->name('destroy');
        Route::get('/{comment}', 'CommentController@show')->name('show');
        Route::get('/{comment}/edit', 'CommentController@edit')->name('edit');
    });

    //媒体库
    Route::get('/media', 'Media\IndexController@index')->name('media.index');
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});
