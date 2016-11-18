<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.media.index', function ($breadcrumbs) {
    $breadcrumbs->push('媒体库', route(env('APP_BACKEND_PREFIX').'.media.index'));
});
