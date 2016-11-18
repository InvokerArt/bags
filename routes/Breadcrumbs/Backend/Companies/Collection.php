<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.companies.index', function ($breadcrumbs) {
    $breadcrumbs->push('公司', route(env('APP_BACKEND_PREFIX').'.companies.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.companies.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.companies.index');
    $breadcrumbs->push('添加公司', route(env('APP_BACKEND_PREFIX').'.companies.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.companies.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.companies.index');
    $breadcrumbs->push('编辑公司', route(env('APP_BACKEND_PREFIX').'.companies.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.jobs.index', function ($breadcrumbs) {
    $breadcrumbs->push('招聘', route(env('APP_BACKEND_PREFIX').'.jobs.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.jobs.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.jobs.index');
    $breadcrumbs->push('添加招聘', route(env('APP_BACKEND_PREFIX').'.jobs.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.jobs.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.jobs.index');
    $breadcrumbs->push('编辑招聘', route(env('APP_BACKEND_PREFIX').'.jobs.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.joins.index', function ($breadcrumbs) {
    $breadcrumbs->push('加盟', route(env('APP_BACKEND_PREFIX').'.joins.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.joins.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.joins.index');
    $breadcrumbs->push('添加加盟', route(env('APP_BACKEND_PREFIX').'.joins.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.joins.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.joins.index');
    $breadcrumbs->push('编辑加盟', route(env('APP_BACKEND_PREFIX').'.joins.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.certifications.index', function ($breadcrumbs) {
    $breadcrumbs->push('认证', route(env('APP_BACKEND_PREFIX').'.certifications.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.certifications.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.certifications.index');
    $breadcrumbs->push('添加认证', route(env('APP_BACKEND_PREFIX').'.certifications.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.certifications.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.certifications.index');
    $breadcrumbs->push('编辑认证', route(env('APP_BACKEND_PREFIX').'.certifications.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.products.index', function ($breadcrumbs) {
    $breadcrumbs->push('产品', route(env('APP_BACKEND_PREFIX').'.products.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.products.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.products.index');
    $breadcrumbs->push('添加产品', route(env('APP_BACKEND_PREFIX').'.products.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.products.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.products.index');
    $breadcrumbs->push('编辑产品', route(env('APP_BACKEND_PREFIX').'.products.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.demands.index', function ($breadcrumbs) {
    $breadcrumbs->push('需求', route(env('APP_BACKEND_PREFIX').'.demands.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.demands.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.demands.index');
    $breadcrumbs->push('添加需求', route(env('APP_BACKEND_PREFIX').'.demands.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.demands.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.demands.index');
    $breadcrumbs->push('编辑需求', route(env('APP_BACKEND_PREFIX').'.demands.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.supplies.index', function ($breadcrumbs) {
    $breadcrumbs->push('供应', route(env('APP_BACKEND_PREFIX').'.supplies.index'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.supplies.create', function ($breadcrumbs) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.supplies.index');
    $breadcrumbs->push('添加供应', route(env('APP_BACKEND_PREFIX').'.supplies.create'));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.supplies.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent(env('APP_BACKEND_PREFIX').'.supplies.index');
    $breadcrumbs->push('编辑供应', route(env('APP_BACKEND_PREFIX').'.supplies.edit', $id));
});
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.companies.categories.index', function ($breadcrumbs) {
    $breadcrumbs->push('分类', route(env('APP_BACKEND_PREFIX').'.companies.categories.index'));
});
