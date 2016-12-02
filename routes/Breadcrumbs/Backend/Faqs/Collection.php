<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.faqs.index', function ($breadcrumbs) {
    $breadcrumbs->push('常见问题', route(env('APP_BACKEND_PREFIX').'.faqs.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.faqs.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.faqs.index');
    $breadcrumbs->push('添加常见问题', route(env('APP_BACKEND_PREFIX').'.faqs.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.faqs.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.faqs.index');
    $breadcrumbs->push('编辑常见问题', route(env('APP_BACKEND_PREFIX').'.faqs.edit', $id));
});
