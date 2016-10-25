<?php

namespace App\Providers;

use App\Models\Jobs\Job;
use App\Policies\JobPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Job::class => JobPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //分发访问 tokens 和 撤销访问 tokens，客户端，私有访问 tokens 注册所必需的路由
        Passport::routes();
        //清理失效的 Tokens
        Passport::pruneRevokedTokens();
    }
}
