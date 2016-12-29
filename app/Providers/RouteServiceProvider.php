<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\Company;
use App\Models\Demand;
use App\Models\Image;
use App\Models\Job;
use App\Models\Join;
use App\Models\News;
use App\Models\Product;
use App\Models\Supply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

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
        /**
         * 新闻软删除绑定
         */
        $this->bind('news', function ($value) {
            $news = new News;
            return News::withTrashed()->where($news->getRouteKeyName(), $value)->first();
        });

        /**
         * 广告软删除绑定
         */
        $this->bind('image', function ($value) {
            $image = new Image;
            return Image::withTrashed()->where($image->getRouteKeyName(), $value)->first();
        });

        /**
         * 广告位软删除绑定
         */
        $this->bind('banner', function ($value) {
            $banner = new Banner;
            return Banner::withTrashed()->where($banner->getRouteKeyName(), $value)->first();
        });

        /**
         * 话题软删除绑定
         */
        $this->bind('topic', function ($value) {
            $topic = new Topic;
            return Topic::withTrashed()->where($topic->getRouteKeyName(), $value)->first();
        });

        /**
         * 公司软删除绑定
         */
        $this->bind('company', function ($value) {
            $company = new Company;
            return Company::withTrashed()->where($company->getRouteKeyName(), $value)->first();
        });

        /**
         * 招聘软删除绑定
         */
        $this->bind('job', function ($value) {
            $job = new Job;
            return Job::withTrashed()->where($job->getRouteKeyName(), $value)->first();
        });

        /**
         * 招聘软删除绑定
         */
        $this->bind('product', function ($value) {
            $product = new Product;
            return Product::withTrashed()->where($product->getRouteKeyName(), $value)->first();
        });

        /**
         * 需求软删除绑定
         */
        $this->bind('demand', function ($value) {
            $demand = new Demand;
            return Demand::withTrashed()->where($demand->getRouteKeyName(), $value)->first();
        });

        /**
         * 供应软删除绑定
         */
        $this->bind('supply', function ($value) {
            $supply = new Supply;
            return Supply::withTrashed()->where($supply->getRouteKeyName(), $value)->first();
        });

        /**
         * 会员软删除绑定
         */
        $this->bind('user', function ($value) {
            $user = new User;
            return User::withTrashed()->where($user->getRouteKeyName(), $value)->first();
        });

        /**
         * 管理员绑定
         */
        $this->bind('admin', function ($value) {
            $admin = new Admin;
            return Admin::withTrashed()->where($admin->getRouteKeyName(), $value)->first();
        });

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
