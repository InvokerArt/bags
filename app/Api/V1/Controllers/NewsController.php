<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\BannerTransformer;
use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\NewsShowTransformer;
use App\Api\V1\Transformers\NewsTransformer;
use App\Models\Banners\Image;
use App\Models\News\CategoriesNews;
use App\Models\News\News;
use Auth;

class NewsController extends BaseController
{

    /**
     * @apiDefine News 新闻
     */

    /**
     * @api {get} /news/banner 新闻轮播图
     * @apiDescription 新闻轮播图
     * @apiGroup News
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *  {
            "data": [
                {
                    "id": 1,
                    "title": "我是标题1",
                    "image_url": "/storage/banners/f53014b75d5d55c2509a462581f49433.png",
                    "order": 1,
                    "link": "",
                    "published_from": "2016-11-30 11:29:24",
                    "published_to": "2016-12-31 11:29:24"
                },
                {
                    "id": 2,
                    "title": "我是标题2",
                    "image_url": "/storage/banners/a766a4fb33a03664caaad1017937f404.png",
                    "order": 2,
                    "link": "",
                    "published_from": "2016-11-30 11:29:53",
                    "published_to": "2016-12-31 11:29:53"
                }
            ]
        }
     * @apiSampleRequest /api/news/banner
     */
    public function banner()
    {
        $images = Image::where('banner_id', 4)->orderBy('order', 'desc')->get();
        return $this->response->collection($images, new BannerTransformer());
    }

    /**
     * @api {get} /news 新闻列表
     * @apiDescription 新闻列表
     * @apiGroup News
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "title": "sed vel asperiores",
                "subtitle": "nisi consectetur ea",
                "image": "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg",
                "updated_at": "2016-11-02 15:59:21"
            },
            {
                "id": 6,
                "title": "aut qui explicabo",
                "subtitle": "esse iste aut",
                "image": "",
                "updated_at": "2016-10-31 19:47:55"
            },
            {
                "id": 13,
                "title": "基于RESTful API 怎么设计用户权限控制？",
                "subtitle": "有人说，每个人都是平等的；\r\n也有人说，人生来就是不平等的；\r\n在人类社会中，并没有绝对的公平，\r\n一件事，并不是所有人都能去做；\r\n一样物，并不是所有人都能够拥有。",
                "image": "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg",
                "updated_at": "2016-11-02 15:57:41"
            }
        ],
        "meta": {
            "pagination": {
                "total": 3,
                "count": 3,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
     * @apiSampleRequest /api/news
     */
    public function index()
    {
        $news = News::with('categories')->paginate();
        return $this->response()->paginator($news, new NewsTransformer());
    }

    /**
     * @api {get} /news/categories/:id 新闻分类列表
     * @apiDescription 新闻分类列表 :id 分类ID
     * @apiGroup News
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "title": "sed vel asperiores",
                "subtitle": "nisi consectetur ea",
                "image": "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg",
                "updated_at": "2016-11-02 15:59:21"
            },
            {
                "id": 6,
                "title": "aut qui explicabo",
                "subtitle": "esse iste aut",
                "image": "",
                "updated_at": "2016-10-31 19:47:55"
            },
            {
                "id": 13,
                "title": "基于RESTful API 怎么设计用户权限控制？",
                "subtitle": "有人说，每个人都是平等的；\r\n也有人说，人生来就是不平等的；\r\n在人类社会中，并没有绝对的公平，\r\n一件事，并不是所有人都能去做；\r\n一样物，并不是所有人都能够拥有。",
                "image": "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg",
                "updated_at": "2016-11-02 15:57:41"
            }
        ],
        "meta": {
            "pagination": {
                "total": 3,
                "count": 3,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
     * @apiSampleRequest /api/news/categories/1
     */
    public function indexByCategories($id)
    {
        $news = News::whereHas('categories', function ($query) use ($id) {
            $query->where('id', $id);
        })->paginate();
        return $this->response()->paginator($news, new NewsTransformer());
    }

    /**
     * @api {get} /news/categories 新闻分类
     * @apiDescription 新闻分类
     * @apiGroup News
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
        {
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
                },
                {
                    "id": 4,
                    "name": "国外市场动态"
                },
                {
                    "id": 5,
                    "name": "行业新闻"
                },
                {
                    "id": 6,
                    "name": "法律法规"
                }
            ]
        }
     * @apiSampleRequest /api/news/categories
     */
    public function categories()
    {
        //激活的分类
        $categories = CategoriesNews::where('is_active', 1)->get();
        return $this->response()->collection($categories, new CategoryTransformer());
    }

    /**
     * @api {get} /news/:id 新闻详情
     * @apiDescription 新闻详情
     * @apiGroup News
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     * {
     *    "data": {
     *       "id": 1,
     *      "title": "sed vel asperiores",
     *      "subtitle": "nisi consectetur ea",
     *      "content": "<p>Ut sit dolore culpa minima. Voluptas corrupti ullam occaecati praesentium quia enim. Dolor incidunt aut repellendus.</p>",
     *      "image": "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg",
     *      "created_at": "2016-10-31 19:38:48"
     *      }
     *}
     * @apiSampleRequest /api/news/1
     */
    public function show(News $news)
    {
        $news->increment('view_count', 1);
        return $this->response->item($news, new NewsShowTransformer());
    }

    /**
     * @api {post} /news/:id/favorites 新闻收藏
     * @apiDescription 新闻收藏
     * @apiGroup News
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     */
    public function favorite(News $news)
    {
        $favorites = $news->whereHas('favorites', function ($query) {
            $query->where('user_id', Auth::id());
        })->first();
        if ($favorites) {
            return $this->response->errorBadRequest('你已经收藏！');
        }
        $news->favorites()->create(['user_id' => Auth::id()]);
        return $this->response->created();
    }
}
