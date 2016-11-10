<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\BannerTransformer;
use App\Models\Banners\Image;

class HomepageController extends BaseController
{

    /**
     * @apiDefine Homepage 首页
     */

    /**
     * @api {get} /banners 首页轮播图
     * @apiDescription 首页轮播图
     * @apiGroup Homepage
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 3,
                "title": "我是首页轮播",
                "image_url": "/storage/banners/f53014b75d5d55c2509a462581f49433.png",
                "order": 3,
                "link": "",
                "published_from": "2016-11-30 11:30:15",
                "published_to": "2016-12-31 11:30:15"
            },
            {
                "id": 4,
                "title": "我是首页轮播",
                "image_url": "/storage/banners/a766a4fb33a03664caaad1017937f404.png",
                "order": 4,
                "link": "",
                "published_from": "2016-11-30 11:30:35",
                "published_to": "2017-01-31 11:30:35"
            }
        ]
    }
     * @apiSampleRequest /api/banners
     */
    public function banner()
    {
        $images = Image::where('banner_id', 1)->orderBy('order', 'desc')->get();
        return $this->response->collection($images, new BannerTransformer());
    }
}
