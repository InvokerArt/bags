<?php
/**
 * 后台导航
 */

//首页
Breadcrumbs::register(env('APP_BACKEND_PREFIX').'.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('首页', route(env('APP_BACKEND_PREFIX').'.dashboard'));
});

/**
 * Access开始
 */
require __DIR__ . '/Breadcrumbs/Backend/Access/Collection.php';

/**
 * 新闻
 */
require __DIR__ . '/Breadcrumbs/Backend/News/Collection.php';

/**
 * 展会
 */
require __DIR__ . '/Breadcrumbs/Backend/Exhibitions/Collection.php';

/**
 * 媒体库
 */
require __DIR__ . '/Breadcrumbs/Backend/Media/Collection.php';

/**
 * 广告
 */
require __DIR__ . '/Breadcrumbs/Backend/Banners/Collection.php';

/**
 * 论坛
 */
require __DIR__ . '/Breadcrumbs/Backend/Topics/Collection.php';

/**
 * 公司
 */
require __DIR__ . '/Breadcrumbs/Backend/Companies/Collection.php';

/**
 * 公司
 */
require __DIR__ . '/Breadcrumbs/Backend/Notifications/Collection.php';

/**
 * 会员
 */
require __DIR__ . '/Breadcrumbs/Backend/Users/Collection.php';

/**
 * 反馈
 */
require __DIR__ . '/Breadcrumbs/Backend/Feedbacks/Collection.php';

/**
 * 常见问题
 */
require __DIR__ . '/Breadcrumbs/Backend/Faqs/Collection.php';

/**
 * 日志
 */
require __DIR__ . '/Breadcrumbs/Backend/Logs/Collection.php';
