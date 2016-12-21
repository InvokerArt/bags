<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
   /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        //wap端路由为了防止和web端路由冲突一定要放到前面
        $this->mapWapRoutes();
        //web端路由
        $this->mapWebRoutes();
        //api路由
        $this->mapApiRoutes();
        //Backend路由
        $this->mapBackendRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => ['api', 'auth:api'],
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }

    /**
     * 自定义后台路由文件
     *
     * @return void
     */
    protected function mapBackendRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
            'prefix' => env('APP_BACKEND_PREFIX'),
        ], function ($router) {
            require base_path('routes/backend.php');
        });
    }

    /**
     * wap路由文件
     *
     * @return void
     */
    protected function mapWapRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
            'domain' => env('APP_WAP_URL'),
        ], function ($router) {
            require base_path('routes/wap.php');
        });
    }
}
