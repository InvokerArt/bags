<?php

/**
 * Backend 路由
 * Namespaces indicate folder structure
 * Admin middleware groups web, auth, and routeNeedsPermission
 */
Route::group(['namespace' => 'Backend', 'as' => env('APP_BACKEND_PREFIX').'.'], function () {
    Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });
    Route::get('location', 'AreaController@province');
    Route::get('location/{city}', 'AreaController@cityOrArea');
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
        Route::post('/user/avatar', 'UserController@avatar')->name('user.avatar');
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

    Route::group(['namespace' => 'Companies', 'as' => 'company.', 'prefix' => 'company'], function () {
        //公司分类
        Route::resource('categories', 'CategoryController', ['except' => 'show']);
        Route::get('categories/children', 'CategoryController@children')->name('categories.children');
        Route::post('categories/move', 'CategoryController@move')->name('categories.move');
        Route::post('categories/copy', 'CategoryController@copy')->name('categories.copy');
        Route::post('categories/rename', 'CategoryController@rename')->name('categories.rename');
        //公司
        Route::get('/get', 'CompanyController@get')->name('get');
        Route::post('/', 'CompanyController@store')->name('store');
        Route::get('/', 'CompanyController@index')->name('index');
        Route::get('/create', 'CompanyController@create')->name('create');
        Route::match(['put', 'patch'], '/{company}', 'CompanyController@update')->name('update');
        Route::delete('/{company}', 'CompanyController@destroy')->name('destroy');
        Route::get('/{company}', 'CompanyController@show')->name('show');
        Route::get('/{company}/edit', 'CompanyController@edit')->name('edit');
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
        Route::resource('/', 'IndexController');
    });

    //评论
    Route::group(['namespace' => 'Comments', 'as' => 'comments.', 'prefix' => 'comments'], function () {
        Route::get('/get', 'CommentController@get')->name('get');
        Route::resource('/', 'CommentController');
    });

    //收藏
    Route::group(['namespace' => 'Favorites', 'as' => 'favorites.', 'prefix' => 'favorites'], function () {
        Route::get('/get', 'FavoriteController@get')->name('get');
        Route::resource('/', 'FavoriteController');
    });

    //媒体库
    Route::get('/media', 'Media\IndexController@index')->name('media.index');
    //普通文件上传
    Route::post('upload', 'UploadController@index')->name('upload.index');
    //营业执照和公司照片文件上传
    Route::post('upload/company', 'Upload\UploadController@company')->name('upload.company');
    Route::delete('upload/company', 'Upload\UploadController@companyDelete')->name('upload.companyDelete');
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});
