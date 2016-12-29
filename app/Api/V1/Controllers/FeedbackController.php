<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\FeedbackStoreRequest;
use App\Repositories\Backend\Feedbacks\FeedbackRepository;

class FeedbackController extends BaseController
{
    protected $feedbacks;

    public function __construct(FeedbackRepository $feedbacks)
    {
        $this->feedbacks = $feedbacks;
    }


    /**
     * @apiDefine Feedback 反馈
     */

    /**
     * @api {post} /feedbacks 提交反馈
     * @apiDescription 提交反馈
     * @apiGroup Feedback
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String} content  反馈内容
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     */
    public function store(FeedbackStoreRequest $request)
    {
        $this->feedbacks->create($request);
        return $this->response->created();
    }
}
