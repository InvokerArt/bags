<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;
use DB;
use Event;

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
        //打印sql  example: http://stone.dev?sql-debug=1开启打印sql语句
        if (env('APP_ENV') === 'local') {
            DB::connection()->enableQueryLog();
        }
        if (env('APP_ENV') === 'local') {
            Event::listen('kernel.handled', function ($request, $response) {
                if ($request->has('sql-debug')) {
                    $queries = DB::getQueryLog();
                    dd($queries);
                }
            });
        }
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
    }
}
