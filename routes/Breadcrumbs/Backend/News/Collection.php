<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.news.index', function ($breadcrumbs) {
    $breadcrumbs->push('资讯', route(env('APP_BACKEND_PREFIX').'.news.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.news.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.news.index');
    $breadcrumbs->push('添加资讯', route(env('APP_BACKEND_PREFIX').'.news.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.news.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.news.index');
    $breadcrumbs->push('编辑资讯', route(env('APP_BACKEND_PREFIX').'.news.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.tags.index', function ($breadcrumbs) {
    $breadcrumbs->push('标签', route(env('APP_BACKEND_PREFIX').'.tags.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.tags.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.tags.index');
    $breadcrumbs->push('编辑标签', route(env('APP_BACKEND_PREFIX').'.tags.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.news.categories.index', function ($breadcrumbs) {
    $breadcrumbs->push('分类', route(env('APP_BACKEND_PREFIX').'.news.categories.index'));
});
