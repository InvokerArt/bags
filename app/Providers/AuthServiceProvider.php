<?php

namespace App\Providers;

use App\Models\Companies\Company;
use App\Models\Demands\Demand;
use App\Models\Favorites\Favorite;
use App\Models\Jobs\Job;
use App\Models\Products\Product;
use App\Models\Supplies\Supply;
use App\Models\Topics\Topic;
use App\Policies\CompanyPolicy;
use App\Policies\DemandPolicy;
use App\Policies\FavoritePolicy;
use App\Policies\JobPolicy;
use App\Policies\ProductPolicy;
use App\Policies\SupplyPolicy;
use App\Policies\TopicPolicy;
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
        Topic::class => TopicPolicy::class,
        Product::class => ProductPolicy::class,
        Demand::class => DemandPolicy::class,
        Supply::class => SupplyPolicy::class,
        Company::class => CompanyPolicy::class,
        Favorite::class => FavoritePolicy::class,
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
