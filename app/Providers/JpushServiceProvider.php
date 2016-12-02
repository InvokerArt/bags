<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JPush\Client as JPush;

class JpushServiceProvider extends ServiceProvider
{
     /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('jpush', function ($app) {
            return new JPush(config('jpush.app_key'), config('jpush.master_secret'), storage_path('logs/jpush.log'));
        });
    }
}
