<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * 自定义验证规则(只能由小写字母组成且首字母必须大写！)
         */
        Validator::extend('alpha_dash_upr_first', function ($attribute, $value, $parameters) {
            if (!preg_match('/^[A-Z]+[a-z]*$/', $value)) {
                return false;
            }
            return true;
        });

        /**
         * 自定义验证规则(只能由小写字母、数字、下划线、横杠组成)
         */
        Validator::extend('alpha_dash_except_num', function ($attribute, $value, $parameters) {
            if (!preg_match('/^[\w\d_-]*$/', $value)) {
                return false;
            }
            return true;
        });

        /**
         * 自定义验证规则(手机)
         */
        Validator::extend('is_mobile', function ($attribute, $value, $parameters) {
            if (!preg_match('/^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|17[678]|18\d)\d{8}|170[059]\d{7})$/', $value)) {
                return false;
            }
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        
        /**
         * 会员
         */
        $this->app->bind(
            \App\Repositories\Backend\Users\UserInterface::class,
            \App\Repositories\Backend\Users\UserRepository::class
        );
        
        /**
         * 新闻
         */
        $this->app->bind(
            \App\Repositories\Backend\News\NewsInterface::class,
            \App\Repositories\Backend\News\NewsRepository::class
        );

        /**
         * 新闻分类
         */
        $this->app->bind(
            \App\Repositories\Backend\News\CategoryInterface::class,
            \App\Repositories\Backend\News\CategoryRepository::class
        );
        
        /**
         * 展会
         */
        $this->app->bind(
            \App\Repositories\Backend\Exhibitions\ExhibitionInterface::class,
            \App\Repositories\Backend\Exhibitions\ExhibitionRepository::class
        );

        /**
         * 展会分类
         */
        $this->app->bind(
            \App\Repositories\Backend\Exhibitions\CategoryInterface::class,
            \App\Repositories\Backend\Exhibitions\CategoryRepository::class
        );

        /**
         * 标签
         */
        $this->app->bind(
            \App\Repositories\Backend\Tags\TagsInterface::class,
            \App\Repositories\Backend\Tags\TagsRepository::class
        );

        /**
         * 公司
         */
        $this->app->bind(
            \App\Repositories\Backend\Companies\CompanyInterface::class,
            \App\Repositories\Backend\Companies\CompanyRepository::class
        );

        /**
         * 公司分类
         */
        $this->app->bind(
            \App\Repositories\Backend\Companies\CategoryInterface::class,
            \App\Repositories\Backend\Companies\CategoryRepository::class
        );
    }
}
