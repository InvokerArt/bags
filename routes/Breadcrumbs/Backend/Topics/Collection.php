<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.topics.index', function ($breadcrumbs) {
    $breadcrumbs->push('话题', route(env('APP_BACKEND_PREFIX').'.topics.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.topics.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.topics.index');
    $breadcrumbs->push('添加话题', route(env('APP_BACKEND_PREFIX').'.topics.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.topics.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.topics.index');
    $breadcrumbs->push('编辑话题', route(env('APP_BACKEND_PREFIX').'.topics.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.replies.index', function ($breadcrumbs) {
    $breadcrumbs->push('回复', route(env('APP_BACKEND_PREFIX').'.replies.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.replies.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.replies.index');
    $breadcrumbs->push('添加回复', route(env('APP_BACKEND_PREFIX').'.replies.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.replies.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.replies.index');
    $breadcrumbs->push('编辑回复', route(env('APP_BACKEND_PREFIX').'.replies.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.topics.categories.index', function ($breadcrumbs) {
    $breadcrumbs->push('分类', route(env('APP_BACKEND_PREFIX').'.topics.categories.index'));
});
