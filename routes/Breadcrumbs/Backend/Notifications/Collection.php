<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.notifications.index', function ($breadcrumbs) {
    $breadcrumbs->push('推送', route(env('APP_BACKEND_PREFIX').'.notifications.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.notifications.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.notifications.index');
    $breadcrumbs->push('添加系统通知', route(env('APP_BACKEND_PREFIX').'.notifications.create'));
});
