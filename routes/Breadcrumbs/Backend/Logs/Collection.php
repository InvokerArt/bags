<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.log-viewer::dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('日志主页', route(env('APP_BACKEND_PREFIX').'.log-viewer::dashboard'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.log-viewer::logs.list', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.log-viewer::dashboard');
    $breadcrumbs->push('日志', route(env('APP_BACKEND_PREFIX').'.log-viewer::logs.list'));
});
