<?php

/**
 * Backend 路由
 * Namespaces indicate folder structure
 * Admin middleware groups web, auth, and routeNeedsPermission
 */
//Route::group(['middleware' => 'cacheable'], function () {
    Route::group(['namespace' => 'Backend', 'as' => env('APP_BACKEND_PREFIX').'.', 'middleware' => 'web'], function () {
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
            Route::get('/admin/get', 'AdminController@get')->name('admin.get');
            Route::resource('/admin', 'AdminController');
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
            Route::post('/', 'UserController@store')->name('store');
            Route::get('/', 'UserController@index')->name('index');
            Route::get('/create', 'UserController@create')->name('create');
            Route::match(['put', 'patch'], '/{user}', 'UserController@update')->name('update');
            Route::delete('/{user}', 'UserController@destroy')->name('destroy');
            Route::get('/{user}', 'UserController@show')->name('show');
            Route::get('/{user}/edit', 'UserController@edit')->name('edit');
            Route::get('/{user}/delete', 'UserController@delete')->name('delete');
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
            Route::get('/{company}/delete', 'CompanyController@delete')->name('delete');
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
            Route::get('/{job}/delete', 'JobController@delete')->name('delete');
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
                Route::get('/{comment}/delete', 'CommentController@delete')->name('delete');
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
            Route::get('/{news}/delete', 'NewsController@delete')->name('delete');
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
            Route::get('/{exhibition}/delete', 'ExhibitionController@delete')->name('delete');
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
            Route::get('/{join}/delete', 'JoinController@delete')->name('delete');
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
            Route::get('/{certification}/delete', 'CertificationController@delete')->name('delete');
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
            Route::get('/{product}/delete', 'ProductController@delete')->name('delete');
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
            Route::get('/{demand}/delete', 'DemandController@delete')->name('delete');
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
            Route::get('/{supply}/delete', 'SupplyController@delete')->name('delete');
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
            Route::get('/{tag}/delete', 'IndexController@delete')->name('delete');
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
            Route::get('/{banner}/delete', 'BannerController@delete')->name('delete');
            Route::get('/{banner}/restore', 'BannerController@restore')->name('restore');
            //轮播图
            Route::get('/image/get', 'ImageController@get')->name('image.get');
            Route::resource('/image', 'ImageController');
            Route::get('/image/{image}/delete', 'ImageController@delete')->name('image.delete');
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
            Route::get('/{topic}/delete', 'TopicController@delete')->name('delete');
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
            Route::get('/{reply}/delete', 'ReplyController@delete')->name('delete');
            Route::get('/{reply}/restore', 'ReplyController@restore')->name('restore');
        });

        //媒体库
        Route::get('/media', 'Media\IndexController@index')->name('media.index');
        Route::get('/', 'DashboardController@index')->name('index');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        //通知
        Route::group(['namespace' => 'Notifications', 'as' => 'notifications.', 'prefix' => 'notifications'], function () {
            Route::get('/get', 'NotificationController@get')->name('get');
            Route::get('/', 'NotificationController@index')->name('index');
            Route::get('create', 'NotificationController@create')->name('create');
            Route::post('/', 'NotificationController@store')->name('store');
            Route::delete('/{notification}', 'NotificationController@destroy')->name('destroy');
        });

        //反馈
        Route::group(['namespace' => 'Feedbacks', 'as' => 'feedbacks.', 'prefix' => 'feedbacks'], function () {
            Route::get('/get', 'FeedbackController@get')->name('get');
            Route::get('/', 'FeedbackController@index')->name('index');
            Route::get('/{feedback}', 'FeedbackController@show')->name('show');
            Route::delete('/{feedback}', 'FeedbackController@destroy')->name('destroy');
        });

        //常见问题
        Route::group(['namespace' => 'Faqs', 'as' => 'faqs.', 'prefix' => 'faqs'], function () {
            Route::get('/get', 'FaqController@get')->name('get');
            Route::get('/', 'FaqController@index')->name('index');
            Route::get('/create', 'FaqController@create')->name('create');
            Route::post('/', 'FaqController@store')->name('store');
            Route::get('{faq}/edit', 'FaqController@edit')->name('edit');
            Route::match(['put', 'patch'], '{faq}', 'FaqController@update')->name('update');
            Route::delete('/{faq}', 'FaqController@destroy')->name('destroy');
        });
    });

    Route::group(['prefix' => 'log-viewer', 'as' => env('APP_BACKEND_PREFIX').'.', 'middleware' => ['admin', 'role:root']], function () {

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
//});
