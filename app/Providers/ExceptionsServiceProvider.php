<?php

namespace App\Providers;

use App\Exceptions\GeneralException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
        //模型未找到的错误消息监管
        app('Dingo\Api\Exception\Handler')->register(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
        });
        //自定义错误消息监管
        app('Dingo\Api\Exception\Handler')->register(function (GeneralException $exception) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException($exception->getMessage());
        });
        //认证失败监管
        app('Dingo\Api\Exception\Handler')->register(function (AuthenticationException $exception) {
            throw new UnauthorizedHttpException('Unauthenticated.', '认证失败');
        });
    }
}
