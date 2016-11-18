<?php
//管理员
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.access.user.index', function ($breadcrumbs) {
    $breadcrumbs->push('管理员管理', route(env('APP_BACKEND_PREFIX').'.access.user.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.access.user.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.access.user.index');
    $breadcrumbs->push('管理员', route(env('APP_BACKEND_PREFIX').'.access.user.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.access.user.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.access.user.index');
    $breadcrumbs->push('管理员', route(env('APP_BACKEND_PREFIX').'.access.user.edit', $id));
});
//角色
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.access.role.index', function ($breadcrumbs) {
    $breadcrumbs->push('管理员管理', route(env('APP_BACKEND_PREFIX').'.access.role.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.access.role.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.access.role.index');
    $breadcrumbs->push('角色管理', route(env('APP_BACKEND_PREFIX').'.access.role.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.access.role.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.access.role.index');
    $breadcrumbs->push('角色管理', route(env('APP_BACKEND_PREFIX').'.access.role.edit', $id));
});
//权限
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.access.permission.index', function ($breadcrumbs) {
    $breadcrumbs->push('管理员管理', route(env('APP_BACKEND_PREFIX').'.access.permission.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.access.permission.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.access.permission.index');
    $breadcrumbs->push('权限管理', route(env('APP_BACKEND_PREFIX').'.access.permission.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.access.permission.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.access.permission.index');
    $breadcrumbs->push('权限管理', route(env('APP_BACKEND_PREFIX').'.access.permission.edit', $id));
});