<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.exhibitions.index', function ($breadcrumbs) {
    $breadcrumbs->push('展会', route(env('APP_BACKEND_PREFIX').'.exhibitions.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.exhibitions.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.exhibitions.index');
    $breadcrumbs->push('添加展会', route(env('APP_BACKEND_PREFIX').'.exhibitions.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.exhibitions.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.exhibitions.index');
    $breadcrumbs->push('编辑展会', route(env('APP_BACKEND_PREFIX').'.exhibitions.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.exhibitions.categories.index', function ($breadcrumbs) {
    $breadcrumbs->push('分类', route(env('APP_BACKEND_PREFIX').'.exhibitions.categories.index'));
});
