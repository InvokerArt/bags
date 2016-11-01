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
     * @api {get} /areas 地区列表
     * @apiDescription 地区列表
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
}
