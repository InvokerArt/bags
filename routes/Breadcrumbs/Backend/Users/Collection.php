<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.users.index', function ($breadcrumbs) {
    $breadcrumbs->push('会员', route(env('APP_BACKEND_PREFIX').'.users.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.users.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.users.index');
    $breadcrumbs->push('添加会员', route(env('APP_BACKEND_PREFIX').'.users.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.users.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.users.index');
    $breadcrumbs->push('编辑会员', route(env('APP_BACKEND_PREFIX').'.users.edit', $id));
});
