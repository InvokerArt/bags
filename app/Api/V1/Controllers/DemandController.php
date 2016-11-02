<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\DemandStoreOrUpdateRequest;
use App\Api\V1\Transformers\DemandShowTransformer;
use App\Api\V1\Transformers\DemandTransformer;
use App\Models\Demands\Demand;
use App\Repositories\Backend\Demands\DemandInterface;

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
                    "/uploads/products/2016/11/165305Y37a.png"
                ]
            },
            {
                "id": 2,
                "title": "我需求100袋包装袋",
                "quantity": 100,
                "unit": 4,
                "images": [
                    "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg"
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
     * @apiSampleRequest /api/demands
     */
    public function index()
    {
        $demands = Demand::paginate();
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
            "id": 1,
            "title": "我需求质量好的袋子",
            "quantity": 1000,
            "unit": 5,
            "content": "<p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">加工定制 是</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">用途 通用包装</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">底面侧面 无底无侧</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">供货类型 可定制</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">规格 400*300（mm*mm）</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">加印LOGO 可以</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">款式 手提袋</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">颜色 米白</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">印刷工艺 丝印</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">自重 285（g）</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">品牌 Martina</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">是否有现货 有</p><p><br/></p>",
            "images": [
                "/uploads/products/2016/11/165305Y37a.png"
            ]
        }
    }
     * @apiSampleRequest /api/demands/1
     */
    public function show(Demand $demand)
    {
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
        $user = $request->user();
        $request->merge(['user_id' => $user->id]);
        $this->demands->create($request);
        return $this->response->created();
    }
}
