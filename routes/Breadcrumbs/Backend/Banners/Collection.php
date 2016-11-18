<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.banners.index', function ($breadcrumbs) {
    $breadcrumbs->push('广告位', route(env('APP_BACKEND_PREFIX').'.banners.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.banners.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.banners.index');
    $breadcrumbs->push('添加广告位', route(env('APP_BACKEND_PREFIX').'.banners.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.banners.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.banners.index');
    $breadcrumbs->push('编辑广告位', route(env('APP_BACKEND_PREFIX').'.banners.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.banners.image.index', function ($breadcrumbs) {
    $breadcrumbs->push('广告', route(env('APP_BACKEND_PREFIX').'.banners.image.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.banners.image.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.banners.image.index');
    $breadcrumbs->push('添加广告', route(env('APP_BACKEND_PREFIX').'.banners.image.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.banners.image.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.banners.image.index');
    $breadcrumbs->push('编辑广告', route(env('APP_BACKEND_PREFIX').'.banners.image.edit', $id));
});
