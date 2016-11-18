<?php
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.feedbacks.index', function ($breadcrumbs) {
    $breadcrumbs->push('反馈', route(env('APP_BACKEND_PREFIX').'.feedbacks.index'));
});
