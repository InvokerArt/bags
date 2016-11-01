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
        //管理员
        Route::get('/user/get', 'AdminController@get')->name('user.get');
        Route::resource('/user', 'AdminController');
        //角色
        Route::get('/role/get', 'RoleController@get')->name('role.get');
        Route::resource('/role', 'RoleController');
        //权限
        Route::get('/permission/get', 'PermissionController@get')->name('permission.get');
        Route::resource('/permission', 'PermissionController');
    });

    Route::group(['namespace' => 'Users', 'as' => 'users.', 'prefix' => 'users'], function () {
        //用户
        Route::get('/get', 'UserController@get')->name('get');
        Route::get('/ajax', 'UserController@info')->name('ajax.info');
        Route::post('/avatar', 'UserController@avatar')->name('avatar');
        Route::get('/deleted/{user}', 'UserController@deleted')->name('deleted');
        Route::post('/', 'UserController@store')->name('store');
        Route::get('/', 'UserController@index')->name('index');
        Route::get('/create', 'UserController@create')->name('create');
        Route::match(['put', 'patch'], '/{user}', 'UserController@update')->name('update');
        Route::delete('/{user}', 'UserController@destroy')->name('destroy');
        Route::get('/{user}', 'UserController@show')->name('show');
        Route::get('/{user}/edit', 'UserController@edit')->name('edit');
        Route::get('/deleted/{user}', 'UserController@deleted')->name('deleted');
        Route::get('/{user}/restore', 'UserController@restore')->name('restore');
    });

    Route::group(['namespace' => 'Companies', 'as' => 'companies.', 'prefix' => 'companies'], function () {
        //公司分类
        Route::resource('categories', 'CategoryController', ['except' => 'show']);
        Route::get('categories/children', 'CategoryController@children')->name('categories.children');
        Route::post('categories/move', 'CategoryController@move')->name('categories.move');
        Route::post('categories/copy', 'CategoryController@copy')->name('categories.copy');
        Route::post('categories/rename', 'CategoryController@rename')->name('categories.rename');
        //公司
        Route::get('/get', 'CompanyController@get')->name('get');
        Route::get('/ajax', 'CompanyController@info')->name('ajax.info');
        Route::post('/', 'CompanyController@store')->name('store');
        Route::get('/', 'CompanyController@index')->name('index');
        Route::get('/create', 'CompanyController@create')->name('create');
        Route::match(['put', 'patch'], '/{company}', 'CompanyController@update')->name('update');
        Route::delete('/{company}', 'CompanyController@destroy')->name('destroy');
        Route::get('/{company}', 'CompanyController@show')->name('show');
        Route::get('/{company}/edit', 'CompanyController@edit')->name('edit');
        Route::get('/deleted/{company}', 'CompanyController@deleted')->name('deleted');
        Route::get('/{company}/restore', 'CompanyController@restore')->name('restore');
    });

    Route::group(['namespace' => 'Jobs', 'as' => 'jobs.', 'prefix' => 'jobs'], function () {
        //招聘
        Route::get('/get', 'JobController@get')->name('get');
        Route::post('/', 'JobController@store')->name('store');
        Route::get('/', 'JobController@index')->name('index');
        Route::get('/create', 'JobController@create')->name('create');
        Route::match(['put', 'patch'], '/{job}', 'JobController@update')->name('update');
        Route::delete('/{job}', 'JobController@destroy')->name('destroy');
        Route::get('/{job}', 'JobController@show')->name('show');
        Route::get('/{job}/edit', 'JobController@edit')->name('edit');
        Route::get('/deleted/{job}', 'JobController@deleted')->name('deleted');
        Route::get('/{job}/restore', 'JobController@restore')->name('restore');
    });

    Route::group(['namespace' => 'News', 'as' => 'news.', 'prefix' => 'news'], function () {
        //新闻分类
        Route::resource('categories', 'CategoryController', ['except' => 'show']);
        Route::get('categories/children', 'CategoryController@children')->name('categories.children');
        Route::post('categories/move', 'CategoryController@move')->name('categories.move');
        Route::post('categories/copy', 'CategoryController@copy')->name('categories.copy');
        Route::post('categories/rename', 'CategoryController@rename')->name('categories.rename');
        //评论
        Route::group(['as' => 'comments.', 'prefix' => 'comments'], function () {
            Route::get('/get', 'CommentController@get')->name('get');
            Route::post('/', 'CommentController@store')->name('store');
            Route::get('/', 'CommentController@index')->name('index');
            Route::get('/create', 'CommentController@create')->name('create');
            Route::match(['put', 'patch'], '/{comment}', 'CommentController@update')->name('update');
            Route::delete('/{comment}', 'CommentController@destroy')->name('destroy');
            Route::get('/{comment}', 'CommentController@show')->name('show');
            Route::get('/{comment}/edit', 'CommentController@edit')->name('edit');
            Route::get('/{comment}/commentto', 'CommentController@commentto')->name('commentto');
            Route::get('/deleted/{comment}', 'CommentController@deleted')->name('deleted');
            Route::get('/{comment}/restore', 'CommentController@restore')->name('restore');
        });
        //新闻
        Route::get('/get', 'NewsController@get')->name('get');
        Route::get('/ajax', 'NewsController@info')->name('ajax.info');
        Route::post('/', 'NewsController@store')->name('store');
        Route::get('/', 'NewsController@index')->name('index');
        Route::get('/create', 'NewsController@create')->name('create');
        Route::match(['put', 'patch'], '/{news}', 'NewsController@update')->name('update');
        Route::delete('/{news}', 'NewsController@destroy')->name('destroy');
        Route::get('/{news}', 'NewsController@show')->name('show');
        Route::get('/{news}/edit', 'NewsController@edit')->name('edit');
        Route::get('/deleted/{news}', 'NewsController@deleted')->name('deleted');
        Route::get('/{news}/restore', 'NewsController@restore')->name('restore');
    });

    Route::group(['namespace' => 'Exhibitions', 'as' => 'exhibitions.', 'prefix' => 'exhibitions'], function () {
        //展会分类
        Route::resource('categories', 'CategoryController', ['except' => 'show']);
        Route::get('categories/children', 'CategoryController@children')->name('categories.children');
        Route::post('categories/move', 'CategoryController@move')->name('categories.move');
        Route::post('categories/copy', 'CategoryController@copy')->name('categories.copy');
        Route::post('categories/rename', 'CategoryController@rename')->name('categories.rename');
        //展会
        Route::get('/get', 'ExhibitionController@get')->name('get');
        Route::post('/', 'ExhibitionController@store')->name('store');
        Route::get('/', 'ExhibitionController@index')->name('index');
        Route::get('/create', 'ExhibitionController@create')->name('create');
        Route::match(['put', 'patch'], '/{exhibition}', 'ExhibitionController@update')->name('update');
        Route::delete('/{exhibition}', 'ExhibitionController@destroy')->name('destroy');
        Route::get('/{exhibition}', 'ExhibitionController@show')->name('show');
        Route::get('/{exhibition}/edit', 'ExhibitionController@edit')->name('edit');
        Route::get('/deleted/{exhibition}', 'ExhibitionController@deleted')->name('deleted');
        Route::get('/{exhibition}/restore', 'ExhibitionController@restore')->name('restore');
    });

    Route::group(['namespace' => 'Joins', 'as' => 'joins.', 'prefix' => 'joins'], function () {
        //加盟
        Route::get('/get', 'JoinController@get')->name('get');
        Route::post('/', 'JoinController@store')->name('store');
        Route::get('/', 'JoinController@index')->name('index');
        Route::get('/create', 'JoinController@create')->name('create');
        Route::match(['put', 'patch'], '/{join}', 'JoinController@update')->name('update');
        Route::delete('/{join}', 'JoinController@destroy')->name('destroy');
        Route::get('/{join}', 'JoinController@show')->name('show');
        Route::get('/{join}/edit', 'JoinController@edit')->name('edit');
        Route::get('/deleted/{join}', 'JoinController@deleted')->name('deleted');
        Route::get('/{join}/restore', 'JoinController@restore')->name('restore');
    });

    Route::group(['namespace' => 'Certifications', 'as' => 'certifications.', 'prefix' => 'certifications'], function () {
        //机构认证
        Route::get('/get', 'CertificationController@get')->name('get');
        Route::post('/', 'CertificationController@store')->name('store');
        Route::get('/', 'CertificationController@index')->name('index');
        Route::get('/create', 'CertificationController@create')->name('create');
        Route::match(['put', 'patch'], '/{certification}', 'CertificationController@update')->name('update');
        Route::delete('/{certification}', 'CertificationController@destroy')->name('destroy');
        Route::get('/{certification}', 'CertificationController@show')->name('show');
        Route::get('/{certification}/edit', 'CertificationController@edit')->name('edit');
        Route::get('/deleted/{certification}', 'CertificationController@deleted')->name('deleted');
        Route::get('/{certification}/restore', 'CertificationController@restore')->name('restore');
    });

    Route::group(['namespace' => 'Products', 'as' => 'products.', 'prefix' => 'products'], function () {
        //产品管理
        Route::get('/get', 'ProductController@get')->name('get');
        Route::post('/', 'ProductController@store')->name('store');
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('/create', 'ProductController@create')->name('create');
        Route::match(['put', 'patch'], '/{product}', 'ProductController@update')->name('update');
        Route::delete('/{product}', 'ProductController@destroy')->name('destroy');
        Route::get('/{product}', 'ProductController@show')->name('show');
        Route::get('/{product}/edit', 'ProductController@edit')->name('edit');
        Route::get('/deleted/{product}', 'ProductController@deleted')->name('deleted');
        Route::get('/{product}/restore', 'ProductController@restore')->name('restore');
    });

    Route::group(['namespace' => 'Demands', 'as' => 'demands.', 'prefix' => 'demands'], function () {
        //需求管理
        Route::get('/get', 'DemandController@get')->name('get');
        Route::post('/', 'DemandController@store')->name('store');
        Route::get('/', 'DemandController@index')->name('index');
        Route::get('/create', 'DemandController@create')->name('create');
        Route::match(['put', 'patch'], '/{demand}', 'DemandController@update')->name('update');
        Route::delete('/{demand}', 'DemandController@destroy')->name('destroy');
        Route::get('/{demand}', 'DemandController@show')->name('show');
        Route::get('/{demand}/edit', 'DemandController@edit')->name('edit');
        Route::get('/deleted/{demand}', 'DemandController@deleted')->name('deleted');
        Route::get('/{demand}/restore', 'DemandController@restore')->name('restore');
    });

    Route::group(['namespace' => 'Supplies', 'as' => 'supplies.', 'prefix' => 'supplies'], function () {
        //供应管理
        Route::get('/get', 'SupplyController@get')->name('get');
        Route::post('/', 'SupplyController@store')->name('store');
        Route::get('/', 'SupplyController@index')->name('index');
        Route::get('/create', 'SupplyController@create')->name('create');
        Route::match(['put', 'patch'], '/{supply}', 'SupplyController@update')->name('update');
        Route::delete('/{supply}', 'SupplyController@destroy')->name('destroy');
        Route::get('/{supply}', 'SupplyController@show')->name('show');
        Route::get('/{supply}/edit', 'SupplyController@edit')->name('edit');
        Route::get('/deleted/{supply}', 'SupplyController@deleted')->name('deleted');
        Route::get('/{supply}/restore', 'SupplyController@restore')->name('restore');
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
        Route::get('/deleted/{tag}', 'IndexController@deleted')->name('deleted');
        Route::get('/{tag}/restore', 'IndexController@restore')->name('restore');
    });

    //收藏
    Route::group(['namespace' => 'Favorites', 'as' => 'favorites.', 'prefix' => 'favorites'], function () {
        Route::get('/get', 'FavoriteController@get')->name('get');
        Route::resource('/', 'FavoriteController');
    });

    //广告
    Route::group(['namespace' => 'Banners', 'as' => 'banners.', 'prefix' => 'banners'], function () {
        //广告位
        Route::get('/get', 'BannerController@get')->name('get');
        Route::post('/', 'BannerController@store')->name('store');
        Route::get('/', 'BannerController@index')->name('index');
        Route::get('/create', 'BannerController@create')->name('create');
        Route::match(['put', 'patch'], '/{banner}', 'BannerController@update')->name('update');
        Route::delete('/{banner}', 'BannerController@destroy')->name('destroy');
        Route::get('/{banner}/edit', 'BannerController@edit')->name('edit');
        Route::get('/deleted/{banner}', 'BannerController@deleted')->name('deleted');
        Route::get('/{banner}/restore', 'BannerController@restore')->name('restore');
        //轮播图
        Route::get('/image/get', 'ImageController@get')->name('image.get');
        Route::resource('/image', 'ImageController');
        Route::get('/image/deleted/{image}', 'ImageController@deleted')->name('image.deleted');
        Route::get('/image/{image}/restore', 'ImageController@restore')->name('image.restore');
    });

    Route::group(['namespace' => 'Topics', 'as' => 'topics.', 'prefix' => 'topics'], function () {
        //论坛分类
        Route::resource('categories', 'CategoryController', ['except' => 'show']);
        Route::get('categories/children', 'CategoryController@children')->name('categories.children');
        Route::post('categories/move', 'CategoryController@move')->name('categories.move');
        Route::post('categories/copy', 'CategoryController@copy')->name('categories.copy');
        Route::post('categories/rename', 'CategoryController@rename')->name('categories.rename');
        //论坛
        Route::get('/get', 'TopicController@get')->name('get');
        Route::post('/', 'TopicController@store')->name('store');
        Route::get('/', 'TopicController@index')->name('index');
        Route::get('/create', 'TopicController@create')->name('create');
        Route::get('/ajax', 'TopicController@info')->name('ajax.info');
        Route::match(['put', 'patch'], '/{topic}', 'TopicController@update')->name('update');
        Route::delete('/{topic}', 'TopicController@destroy')->name('destroy');
        Route::get('/{topic}', 'TopicController@show')->name('show');
        Route::get('/{topic}/edit', 'TopicController@edit')->name('edit');
        Route::get('/deleted/{topic}', 'TopicController@deleted')->name('deleted');
        Route::get('/{topic}/restore', 'TopicController@restore')->name('restore');
    });

    //回帖
    Route::group(['namespace' => 'Topics', 'as' => 'replies.', 'prefix' => 'replies'], function () {
        Route::get('/get', 'ReplyController@get')->name('get');
        Route::post('/', 'ReplyController@store')->name('store');
        Route::get('/', 'ReplyController@index')->name('index');
        Route::get('/create', 'ReplyController@create')->name('create');
        Route::match(['put', 'patch'], '/{reply}', 'ReplyController@update')->name('update');
        Route::delete('/{reply}', 'ReplyController@destroy')->name('destroy');
        Route::get('/{reply}', 'ReplyController@show')->name('show');
        Route::get('/{reply}/edit', 'ReplyController@edit')->name('edit');
        Route::get('/{reply}/replyto', 'ReplyController@replyto')->name('replyto');
        Route::get('/deleted/{reply}', 'ReplyController@deleted')->name('deleted');
        Route::get('/{reply}/restore', 'ReplyController@restore')->name('restore');
    });

    //媒体库
    Route::get('/media', 'Media\IndexController@index')->name('media.index');
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

Route::group(['prefix' => 'log-viewer', 'as' => env('APP_BACKEND_PREFIX').'.', 'middleware' => 'admin'], function () {

    Route::get('/', [
        'as'   => 'log-viewer::dashboard',
        'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index',
    ]);

    Route::group(['prefix' => 'logs',], function () {
        Route::get('/', [
            'as'   => 'log-viewer::logs.list',
            'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs',
        ]);
        Route::delete('delete', [
            'as'   => 'log-viewer::logs.delete',
            'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete',
        ]);
    });

    Route::group(['prefix' => '{date}'], function () {
        Route::get('/', [
            'as'   => 'log-viewer::logs.show',
            'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@show',
        ]);
        Route::get('download', [
            'as'   => 'log-viewer::logs.download',
            'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@download',
        ]);
        Route::get('{level}', [
            'as'   => 'log-viewer::logs.filter',
            'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel',
        ]);
    });
});
