<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\AreaTransformer;
use App\Models\Area;

class AreaController extends BaseController
{

    /**
     * @apiDefine Area 地区
     */

    /**
     * @api {get} /areas 全部数据
     * @apiDescription 全部数据
     * @apiGroup Area
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
        {
            "data": [
                {
                    "id": 1,
                    "code": 340000,
                    "parent_id": 0,
                    "name": "安徽"
                },
                {
                    "id": 2,
                    "code": 110000,
                    "parent_id": 0,
                    "name": "北京"
                },
                {
                    "id": 3,
                    "code": 500000,
                    "parent_id": 0,
                    "name": "重庆"
                }
                ...
            ]
        }
     * @apiSampleRequest /api/areas
     */
    public function index()
    {
        $areas = Area::all();
        return $this->response->collection($areas, new AreaTransformer);
    }

    /**
     * @api {get} /areas/:code 单个地区
     * @apiDescription 单个地区 :code 通过code查询地区
     * @apiGroup Area
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
        {
            "data": [
                {
                    "id": 1,
                    "code": 340000,
                    "parent_id": 0,
                    "name": "安徽"
                }
            ]
        }
     * @apiSampleRequest /api/areas/340000
     */
    public function show($code)
    {
        $area = Area::where('code', $code)->first();
        return $this->response->item($area, new AreaTransformer);
    }

    /**
     * @api {get} /childrens/:code 子地区
     * @apiDescription 子地区 :code 通过code查询子地区
     * @apiGroup Area
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
        {
            "data": [
                {
                    "id": 1,
                    "code": 340000,
                    "parent_id": 0,
                    "name": "安徽"
                }
            ]
        }
     * @apiSampleRequest /api/childrens/340000
     */
    public function children($code)
    {
        $areas = Area::where('parent_id', $code)->get();
        return $this->response->collection($areas, new AreaTransformer);
    }

    /**
     * @api {get} /provinces 所有省
     * @apiDescription 所有省
     * @apiGroup Area
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
        {
            "data": [
                {
                    "id": 1,
                    "code": 340000,
                    "parent_id": 0,
                    "name": "安徽"
                }
            ]
        }
     * @apiSampleRequest /api/provinces
     */
    public function province()
    {
        $provinces = Area::where('parent_id', 0)->get();
        return $this->response->collection($provinces, new AreaTransformer);
    }

    /**
     * @api {get} /citys 所有市区
     * @apiDescription 所有市区
     * @apiGroup Area
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
        {
            "data": [
                {
                    "id": 1,
                    "code": 340000,
                    "parent_id": 0,
                    "name": "安徽"
                }
            ]
        }
     * @apiSampleRequest /api/citys
     */
    public function city()
    {
        $provinces = Area::where('parent_id', 0)->with('childrens')->get();
        foreach ($provinces as $key => $province) {
            $citys[] = $province->childrens;
        }
        $citys = collect($citys);
        $citys = $citys->collapse();
        return $this->response->collection($citys, new AreaTransformer);
    }

    public function area()
    {
        $provinces = Area::where('parent_id', 0)->with('childrens')->get();
        foreach ($provinces as $key => $province) {
            $citys[] = $province->childrens;
        }
        $citys = collect($citys);
        $citys = $citys->collapse();
        foreach ($citys as $value) {
            $areas[] = Area::where('parent_id', $value->code)->get();
        }
        $areas = collect($areas);
        $areas = $areas->collapse();
        return $this->response->collection($areas, new AreaTransformer);
    }
}
