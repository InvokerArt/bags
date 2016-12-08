<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\FaqTransformer;
use App\Models\Faqs\Faq;

class FaqController extends BaseController
{


    /**
     * @apiDefine Faq 常见问题
     */

    /**
     * @api {get} /faqs 常见问题
     * @apiDescription 常见问题
     * @apiGroup Faq
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "title": "常见问题1",
                "content": "<p>常见问题内容那就是巴拉巴拉</p>"
            },
            {
                "id": 2,
                "title": "常见问题2",
                "content": "<p>阿达大大大</p>"
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
     */
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'DESC')->paginate();
        return $this->response->paginator($faqs, new FaqTransformer());
    }
}
