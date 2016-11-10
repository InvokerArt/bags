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
         * 评论
         */
        $this->app->bind(
            \App\Repositories\Backend\Comments\CommentInterface::class,
            \App\Repositories\Backend\Comments\CommentRepository::class
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

        /**
         * 招聘
         */
        $this->app->bind(
            \App\Repositories\Backend\Jobs\JobInterface::class,
            \App\Repositories\Backend\Jobs\JobRepository::class
        );

        /**
         * 认证
         */
        $this->app->bind(
            \App\Repositories\Backend\Joins\JoinInterface::class,
            \App\Repositories\Backend\Joins\JoinRepository::class
        );

        /**
         * 认证
         */
        $this->app->bind(
            \App\Repositories\Backend\Certifications\CertificationInterface::class,
            \App\Repositories\Backend\Certifications\CertificationRepository::class
        );

        /**
         * 产品
         */
        $this->app->bind(
            \App\Repositories\Backend\Products\ProductInterface::class,
            \App\Repositories\Backend\Products\ProductRepository::class
        );

        /**
         * 需求
         */
        $this->app->bind(
            \App\Repositories\Backend\Demands\DemandInterface::class,
            \App\Repositories\Backend\Demands\DemandRepository::class
        );

        /**
         * 供应
         */
        $this->app->bind(
            \App\Repositories\Backend\Supplies\SupplyInterface::class,
            \App\Repositories\Backend\Supplies\SupplyRepository::class
        );

        /**
         * 广告位
         */
        $this->app->bind(
            \App\Repositories\Backend\Banners\BannerInterface::class,
            \App\Repositories\Backend\Banners\BannerRepository::class
        );

        /**
         * 轮播图
         */
        $this->app->bind(
            \App\Repositories\Backend\Banners\ImageInterface::class,
            \App\Repositories\Backend\Banners\ImageRepository::class
        );

        /**
         * 话题
         */
        $this->app->bind(
            \App\Repositories\Backend\Topics\TopicInterface::class,
            \App\Repositories\Backend\Topics\TopicRepository::class
        );

        /**
         * 话题分类
         */
        $this->app->bind(
            \App\Repositories\Backend\Topics\CategoryInterface::class,
            \App\Repositories\Backend\Topics\CategoryRepository::class
        );

        /**
         * 回复
         */
        $this->app->bind(
            \App\Repositories\Backend\Topics\ReplyInterface::class,
            \App\Repositories\Backend\Topics\ReplyRepository::class
        );

        /**
         * 通知
         */
        $this->app->bind(
            \App\Repositories\Backend\Notifications\NotificationInterface::class,
            \App\Repositories\Backend\Notifications\NotificationRepository::class
        );
    }
}
