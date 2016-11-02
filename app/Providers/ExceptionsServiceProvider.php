<?php

namespace App\Providers;

use App\Exceptions\GeneralException;
use Illuminate\Support\ServiceProvider;

class ExceptionsServiceProvider extends ServiceProvider
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
        app('Dingo\Api\Exception\Handler')->register(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
        });
        app('Dingo\Api\Exception\Handler')->register(function (GeneralException $exception) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException($exception->getMessage());
        });
    }
}
