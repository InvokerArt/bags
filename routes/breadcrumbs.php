<?php
/**
 * 后台导航
 */
//首页
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('首页', route(env('APP_BACKEND_PREFIX').'.dashboard'));
});

/**
 * Access开始
 */
require __DIR__ . '/Breadcrumbs/Backend/Access/Collection.php';
