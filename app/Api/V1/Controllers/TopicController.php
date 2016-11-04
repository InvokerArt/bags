<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\TopicStoreOrUpdateRequest;
use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\TopicTransformer;
use App\Models\Topics\CategoriesTopics;
use App\Models\Topics\Topic;
use App\Models\Topics\Voter;
use App\Models\Users\User;
use App\Repositories\Backend\Topics\TopicInterface;
use Auth;
use Gate;
use Illuminate\Http\Request;

class TopicController extends BaseController
{
    protected $topics;

    public function __construct(TopicInterface $topics)
    {
        $this->topics = $topics;
    }

    /**
     * @apiDefine Topic 论坛
     */

    /**
     * @api {get} /topics/categories 论坛分类
     * @apiDescription 论坛所有分类
     * @apiGroup Topic
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "name": "专业知识"
            },
            {
                "id": 2,
                "name": "活动交友"
            },
            {
                "id": 3,
                "name": "新闻资讯"
            },
            {
                "id": 4,
                "name": "商务合作"
            },
            {
                "id": 5,
                "name": "财经金融"
            },
            {
                "id": 6,
                "name": "反馈建议"
            }
        ]
    }
     * @apiSampleRequest /api/topics/categories
     */
    public function categories()
    {
        //激活的分类
        $categories = CategoriesTopics::where('is_active', 1)->get();
        return $this->response()->collection($categories, new CategoryTransformer());
    }

    /**
     * @api {get} /topics/categories/:id 话题列表
     * @apiDescription 话题列表 :id 论坛分类ID
     * @apiGroup Topic
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     * @apiSampleRequest /api/topics/categories/1
     */
    public function index($id, Request $request, Topic $topic)
    {
        $category = CategoriesTopics::findOrFail($id);
        $filter = $topic->correctApiFilter($request->get('filters'));
        $topics = $topic->getCategoryTopicsWithFilter($filter, $id);
        return $this->response()->paginator($topics, new TopicTransformer());
    }

    /**
     * @api {get} /users/:id/topics 用户话题列表
     * @apiDescription 用户话题列表 :id 用户ID
     * @apiGroup Auth
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     * @apiSampleRequest /api/users/1/topics
     */
    public function indexByUserId($user_id)
    {
        $topics = Topic::whose($user_id)->recent()->paginate();
        return $this->response()->paginator($topics, new TopicTransformer());
    }

    /**
     * @api {get} /users/:id/votes 用户点赞列表
     * @apiDescription 用户点赞列表 :id 用户ID
     * @apiGroup Auth
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     * @apiSampleRequest /api/users/1/votes
     */
    public function indexByUserVotes($user_id)
    {
        $user = User::findOrFail($user_id);
        $topics = $user->votedTopics()->orderBy('pivot_created_at', 'desc')->paginate();
        return $this->response()->paginator($topics, new TopicTransformer());
    }

    /**
     * @api {get} /topics/:id 话题详情
     * @apiDescription 话题详情
     * @apiGroup Topic
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "id": 1,
            "category_id": 2,
            "title": "Laravel 5.3 中文文档翻译完成",
            "content": "<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \" hiragino=\"\" sans=\"\" microsoft=\"\" wenquanyi=\"\" micro=\"\" white-space:=\"\" background-color:=\"\"><img src=\"https://dn-phphub.qbox.me/uploads/images/201608/24/1/IEQ4Xir8sH.jpg\" alt=\"\" data-type=\"image\" style=\"box-sizing: border-box; border: 1px solid rgb(221, 221, 221); vertical-align: middle; max-width: 100%; box-shadow: rgb(204, 204, 204) 0px 0px 30px; margin-bottom: 30px; margin-top: 10px;\"/></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \" hiragino=\"\" sans=\"\" microsoft=\"\" wenquanyi=\"\" micro=\"\" white-space:=\"\" background-color:=\"\">文档地址在此：<a href=\"https://laravel-china.org/docs/5.3\" style=\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\">https://laravel-china.org/docs/5.3</a></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \" hiragino=\"\" sans=\"\" microsoft=\"\" wenquanyi=\"\" micro=\"\" white-space:=\"\" background-color:=\"\">翻译的召集帖：<a href=\"https://laravel-china.org/topics/2752\" style=\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\">https://laravel-china.org/topics/2752</a></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \" hiragino=\"\" sans=\"\" microsoft=\"\" wenquanyi=\"\" micro=\"\" white-space:=\"\" background-color:=\"\">参与人员列表：<a href=\"https://laravel-china.org/roles/7\" style=\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\">Laravel 5.3 译者</a></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \" hiragino=\"\" sans=\"\" microsoft=\"\" wenquanyi=\"\" micro=\"\" white-space:=\"\" background-color:=\"\">项目托管在 Github 上，欢迎提交反馈：<a href=\"https://github.com/laravel-china/laravel-docs\" style=\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\">https://github.com/laravel-china/laravel-docs</a></p><blockquote style=\"box-sizing: border-box; padding: 6px 8px; border-left: 4px solid rgb(221, 221, 221); line-height: 30px; color: rgb(119, 119, 119); background-color: rgb(247, 247, 247); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \" hiragino=\"\" sans=\"\" microsoft=\"\" wenquanyi=\"\" micro=\"\" white-space:=\"\" margin:=\"\" 20px=\"\" 0px=\"\"><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; line-height: 30px;\">我代表 Laravel 中文文档的受益者对 可爱的&nbsp;<a href=\"https://laravel-china.org/roles/7\" style=\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\">Laravel 5.3 译者</a>&nbsp;表示感谢&nbsp;<img title=\":beer:\" alt=\":beer:\" class=\"emoji\" src=\"https://dn-phphub.qbox.me/assets/images/emoji/beer.png\" align=\"absmiddle\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; width: 1.6em; display: inline-block; margin-bottom: 0px; margin-top: -5px; margin-left: 5px; max-width: 100%;\"/>&nbsp;<img title=\":metal:\" alt=\":metal:\" class=\"emoji\" src=\"https://dn-phphub.qbox.me/assets/images/emoji/metal.png\" align=\"absmiddle\" style=\"box-sizing: border-box; border: 0px; vertical-align: middle; width: 1.6em; display: inline-block; margin-bottom: 0px; margin-top: -5px; margin-left: 5px; max-width: 100%;\"/></p></blockquote><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \" hiragino=\"\" sans=\"\" microsoft=\"\" wenquanyi=\"\" micro=\"\" white-space:=\"\" background-color:=\"\"><img src=\"https://dn-phphub.qbox.me/uploads/images/201610/19/1/F9kV4goXoU.png\" alt=\"\" data-type=\"image\" style=\"box-sizing: border-box; border: 1px solid rgb(221, 221, 221); vertical-align: middle; max-width: 100%; box-shadow: rgb(204, 204, 204) 0px 0px 30px; margin-bottom: 30px; margin-top: 10px;\"/></p><p><br/></p>",
            "reply_count": 4,
            "vote_count": 0,
            "vote_up": 0,
            "vote_down": 0,
            "updated_at": "2016-11-03",
            "user": {
                "data": {
                    "id": 2,
                    "username": "user",
                    "mobile": "13113113111",
                    "email": "user@user.com",
                    "avatar": "",
                    "created_at": "2016-11-02 15:57:24"
                }
            }
        }
    }
     * @apiSampleRequest /api/topics/1
     */
    public function show(Topic $topic)
    {
        $topic->increment('view_count', 1);
        return $this->response->item($topic, new TopicTransformer());
    }

    /**
     * @api {post} /topics 发布话题
     * @apiDescription 发布话题
     * @apiGroup Topic
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String} title 标题
     * @apiParam {String} content 内容
     * @apiParam {Number=1,2,3,4,5,6} category_id
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/topics
     */
    public function store(TopicStoreOrUpdateRequest $request)
    {
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);
        $topic = $this->topics->create($request);
        $user->increment('topic_count', 1);
        return $this->response->created(env('APP_URL').'api/topics/'.$topic->id, $topic);
    }

    /**
     * @api {delete} /topics/:id 删除话题
     * @apiDescription 删除话题 :id 需要删除话题的ID
     * @apiGroup Topic
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No Content
     */
    public function destroy(Topic $topic)
    {
        $user = Auth::user();

        if (!$user->can('delete', $topic)) {
            return $this->response->errorForbidden();
        }

        $topic->delete();
        return $this->response->noContent();
    }

    /**
     * @api {delete} /topics/:id/vote-up 话题点赞
     * @apiDescription 话题点赞 :id
     * @apiGroup Topic
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No Content
     */
    public function voteUp(Topic $topic)
    {
        Voter::topicUpVote($topic);
        return $this->response->noContent();
    }

    public function voteDown(Topic $topic)
    {
        Voter::topicDownVote($topic);
        return $this->response->noContent();
    }
}
