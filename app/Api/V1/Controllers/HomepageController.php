<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\BannerTransformer;
use App\Api\V1\Transformers\ExhibitionTransformer;
use App\Api\V1\Transformers\HomeTransformer;
use App\Api\V1\Transformers\NewsTransformer;
use App\Models\Image;
use App\Models\Exhibition;
use App\Models\News;
use App\Repositories\Backend\Banners\ImageRepository;

class HomepageController extends BaseController
{
    protected $image;

    public function __construct(ImageRepository $image)
    {
        $this->image = $image;
    }


    /**
     * @apiDefine Homepage 首页
     */

    /**
     * @api {get} /home 首页
     * @apiDescription 首页（包含轮播图、新闻、展会）
     * @apiGroup Homepage
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "banners": [
                {
                    "id": 9,
                    "title": "我是首页轮播图3",
                    "image_url": "http://stone.dev/storage/banners/f53014b75d5d55c2509a462581f49433.png",
                    "order": 9,
                    "link": "",
                    "published_from": "2016-11-30 04:02:05",
                    "published_to": "2016-11-30 04:02:05"
                },
                {
                    "id": 4,
                    "title": "我是首页轮播",
                    "image_url": "http://stone.dev/storage/banners/a766a4fb33a03664caaad1017937f404.png",
                    "order": 4,
                    "link": "",
                    "published_from": "2016-11-30 11:30:35",
                    "published_to": "2017-01-31 11:30:35"
                },
                {
                    "id": 3,
                    "title": "我是首页轮播",
                    "image_url": "http://stone.dev/storage/banners/f53014b75d5d55c2509a462581f49433.png",
                    "order": 3,
                    "link": "",
                    "published_from": "2016-11-30 11:30:15",
                    "published_to": "2016-12-31 11:30:15"
                }
            ],
            "news": {
                "id": 13,
                "title": "基于RESTful API 怎么设计用户权限控制？",
                "subtitle": "有人说，每个人都是平等的；\r\n也有人说，人生来就是不平等的；\r\n在人类社会中，并没有绝对的公平，\r\n一件事，并不是所有人都能去做；\r\n一样物，并不是所有人都能够拥有。",
                "image": "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg",
                "updated_at": "2016-11-14 06:45:31",
                "is_excellent": 1,
                "is_top": 1,
                "categories": {
                    "data": [
                        {
                            "id": 1,
                            "name": "可降解知识"
                        },
                        {
                            "id": 2,
                            "name": "高分子知识"
                        },
                        {
                            "id": 3,
                            "name": "国内市场动态"
                        }
                    ]
                }
            },
            "exhibition": {
                "id": 1,
                "title": "有一个展会",
                "address": "xiamen",
                "telephone": "05925910000",
                "image": "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg",
                "is_excellent": 1,
                "is_top": 1
            }
        }
    }
     * @apiSampleRequest /api/home
     */
    public function index()
    {
        $banners = $this->image->getCategoryBanners(1);
        $banners = json_decode($this->response->collection($banners, new BannerTransformer())->morph()->content(), true);
        $data['data']['banners'] = $banners['data'];
        $news = News::where('is_excellent', 'yes')->with('categories')->first();
        $news = json_decode($this->response->item($news, new NewsTransformer())->morph()->content(), true);
        $data['data']['news'] = $news['data'];
        $exhibition = Exhibition::where('is_excellent', 'yes')->first();
        $exhibition = json_decode($this->response->item($exhibition, new ExhibitionTransformer())->morph()->content(), true);
        $data['data']['exhibition'] = $exhibition['data'];
        return $this->response->array($data);
    }
}
