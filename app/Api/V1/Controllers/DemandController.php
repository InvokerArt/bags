<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\DemandStoreOrUpdateRequest;
use App\Api\V1\Transformers\DemandShowTransformer;
use App\Api\V1\Transformers\DemandTransformer;
use App\Models\Demand;
use App\Repositories\Backend\Demands\DemandInterface;
use Auth;
use Illuminate\Http\Request;

class DemandController extends BaseController
{
    protected $demands;

    public function __construct(DemandInterface $demands)
    {
        $this->demands = $demands;
    }

    /**
     * @apiDefine Demand 需求
     */

    /**
     * @api {get} /demands 需求列表
     * @apiDescription 需求列表
     * @apiGroup Demand
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "title": "我需求质量好的袋子",
                "quantity": 1000,
                "unit": 5,
                "images": [
                    "http://stone.dev/uploads/products/2016/11/165305Y37a.png"
                ],
                "is_excellent": 0
            },
            {
                "id": 2,
                "title": "我需求100袋包装袋",
                "quantity": 100,
                "unit": 4,
                "images": [
                    "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
                ],
                "is_excellent": 0
            },
            {
                "id": 3,
                "title": "我需求100袋包装袋",
                "quantity": 1000,
                "unit": 5,
                "images": [
                    "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
                ],
                "is_excellent": 1
            },
            {
                "id": 4,
                "title": "ghvff",
                "quantity": 45,
                "unit": 3,
                "images": "http://192.168.1.41:8000/uploads/avatars/20161119060951_180x180.png",
                "is_excellent": 0
            }
        ],
        "meta": {
            "pagination": {
                "total": 4,
                "count": 4,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
     * @apiSampleRequest /api/demands
     */
    public function index()
    {
        $demands = Demand::orderBy('created_at', 'DESC')->paginate();
        return $this->response()->paginator($demands, new DemandTransformer());
    }

    /**
     * @api {get} /users/demands 需求列表
     * @apiDescription 需求列表
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "title": "我需求质量好的袋子",
                "quantity": 1000,
                "unit": 5,
                "images": [
                    "/uploads/products/2016/11/165305Y37a.png"
                ]
            }
        ],
        "meta": {
            "pagination": {
                "total": 2,
                "count": 2,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
     * @apiSampleRequest /api/users/demands
     */
    public function indexByUser()
    {
        $demands = Demand::where('user_id', Auth::id())->orderBy('is_excellent')->orderBy('created_at', 'DESC')->paginate();
        return $this->response()->paginator($demands, new DemandTransformer());
    }

    /**
     * @api {get} /demands/:id 需求详情
     * @apiDescription 需求详情 :id 需求ID
     * @apiGroup Demand
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "id": 2,
            "title": "我需求100袋包装袋",
            "quantity": 100,
            "unit": 4,
            "content": "我就需要这么多包装袋",
            "images": [
                "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
            ],
            "is_excellent": 0,
            "province": "福建省",
            "city": "厦门市",
            "area": "思明区",
            "addressDetail": "HK排比哈哈哈哈他JJ他拒绝离开过来了来了太可怜了啦啦啦啦",
            "user": {
                "data": {
                    "id": 1,
                    "username": "admin",
                    "name": "管理员",
                    "mobile": "13111111111",
                    "email": "admin@admin.com",
                    "avatar": {
                        "_default": "http://117.29.170.226:8000/uploads/avatars/20161212022331.png",
                        "small": "http://117.29.170.226:8000/uploads/avatars/20161212022331_30x30.png",
                        "medium": "http://117.29.170.226:8000/uploads/avatars/20161212022331_65x65.png",
                        "large": "http://117.29.170.226:8000/uploads/avatars/20161212022331_180x180.png"
                    },
                    "created_at": "2016-11-02 07:57:24"
                }
            }
        }
    }
     * @apiSampleRequest /api/demands/1
     */
    public function show(Demand $demand)
    {
        $demand->user = $demand->user()->first();
        $company = $demand->company()->first();
        $demand->address = $company->address;
        $demand->addressDetail = $company->addressDetail;
        return $this->response->item($demand, new DemandShowTransformer());
    }

    /**
     * @api {post} /demands 发布需求
     * @apiDescription 发布需求 unit代表的单位见顶部(接口说明)
     * @apiGroup Demand
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String} title 标题
     * @apiParam {Int} quantity 数量
     * @apiParam {Number=1,2,3,4,5} unit 单位
     * @apiParam {String[]} images[] 图片
     * @apiParam {String} content 内容
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/demands
     */
    public function store(DemandStoreOrUpdateRequest $request)
    {
        $user = Auth::user();
        if (!$user->company) {
            return $this->response->errorBadRequest('请先完善公司信息！');
        }
        $request->merge(['user_id' => $user->id]);
        $request->images = relative_url($request->images);
        $this->demands->create($request);
        return $this->response->created();
    }

    /**
     * @api {PATCH} /demands/:id 更新需求
     * @apiDescription 更新需求 :id为需求ID
     * @apiGroup Demand
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String} title 标题
     * @apiParam {Int} quantity 数量
     * @apiParam {Number=1,2,3,4,5} unit 单位
     * @apiParam {String[]} images[] 图片
     * @apiParam {String} content 内容
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "id": 3,
            "title": "我需求100袋包装袋",
            "quantity": "1000",
            "unit": "5",
            "content": "我就需要这么多包装袋",
            "images": [
                "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
            ]
        }
    }
     * @apiSampleRequest /api/demands/1
     */
    public function update(Demand $demand, DemandStoreOrUpdateRequest $request)
    {
        $user = Auth::user();

        if (!$user->can('update', $demand)) {
            return $this->response->errorForbidden();
        }

        $request->images = relative_url($request->images);
        $this->demands->update($demand, $request);
        return $this->response->item($demand, new DemandShowTransformer());
    }

    /**
     * @api {delete} /demands/:id 删除需求
     * @apiDescription 删除需求 :id 需要删除需求的ID
     * @apiGroup Demand
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No Content
     */
    public function destroy(Demand $demand)
    {
        $user = Auth::user();

        if (!$user->can('delete', $demand)) {
            return $this->response->errorForbidden();
        }

        $demand->delete();
        return $this->response->noContent();
    }

    /**
     * @api {post} /demands/:id/favorites 需求收藏
     * @apiDescription 需求收藏
     * @apiGroup Demand
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     */
    public function favorite(Demand $demand)
    {
        $favorites = $demand->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            return $this->response->errorBadRequest('你已经收藏！');
        }
        $demand->favorites()->create(['user_id' => Auth::id()]);
        return $this->response->created();
    }

    /**
     * @api {get} /demands/search 需求搜索
     * @apiDescription 需求搜索
     * @apiGroup Demand
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiParam {String} q 搜索关键字
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "title": "我需求质量好的袋子",
                "quantity": 1000,
                "unit": 5,
                "images": [
                    "http://stone.dev/uploads/products/2016/11/165305Y37a.png"
                ],
                "is_excellent": 0
            },
            {
                "id": 2,
                "title": "我需求100袋包装袋",
                "quantity": 100,
                "unit": 4,
                "images": [
                    "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
                ],
                "is_excellent": 0
            },
            {
                "id": 3,
                "title": "我需求100袋包装袋",
                "quantity": 1000,
                "unit": 5,
                "images": [
                    "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
                ],
                "is_excellent": 1
            },
            {
                "id": 4,
                "title": "我需求100袋包装袋",
                "quantity": 100,
                "unit": 4,
                "images": [
                    "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
                ],
                "is_excellent": 0
            },
            {
                "id": 6,
                "title": "我需求100袋包装袋",
                "quantity": 100,
                "unit": 4,
                "images": [
                    "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
                ],
                "is_excellent": 0
            }
        ],
        "meta": {
            "pagination": {
                "total": 5,
                "count": 5,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
     * @apiSampleRequest /api/demands/search
     */
    public function search(Request $request)
    {
        $demands = $this->demands->search($request);
        return $this->response->paginator($demands, new DemandTransformer());
    }

    /**
     * @api {get} /users/demands/search 需求搜索
     * @apiDescription 需求搜索
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String} q 搜索关键字
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "title": "我需求质量好的袋子",
                "quantity": 1000,
                "unit": 5,
                "images": [
                    "http://stone.dev/uploads/products/2016/11/165305Y37a.png"
                ],
                "is_excellent": 0
            },
            {
                "id": 2,
                "title": "我需求100袋包装袋",
                "quantity": 100,
                "unit": 4,
                "images": [
                    "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
                ],
                "is_excellent": 0
            },
            {
                "id": 3,
                "title": "我需求100袋包装袋",
                "quantity": 1000,
                "unit": 5,
                "images": [
                    "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
                ],
                "is_excellent": 1
            },
            {
                "id": 4,
                "title": "我需求100袋包装袋",
                "quantity": 100,
                "unit": 4,
                "images": [
                    "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
                ],
                "is_excellent": 0
            },
            {
                "id": 6,
                "title": "我需求100袋包装袋",
                "quantity": 100,
                "unit": 4,
                "images": [
                    "http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
                ],
                "is_excellent": 0
            }
        ],
        "meta": {
            "pagination": {
                "total": 5,
                "count": 5,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
     * @apiSampleRequest /api/users/demands/search
     */
    public function searchWithUser(Request $request)
    {
        $demands = $this->demands->searchWithUser($request);
        return $this->response->paginator($demands, new DemandTransformer());
    }
}
