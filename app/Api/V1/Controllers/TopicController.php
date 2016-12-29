<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\ReplyStoreOrUpdateRequest;
use App\Api\V1\Requests\TopicStoreOrUpdateRequest;
use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\ReplyTransformer;
use App\Api\V1\Transformers\TopicTransformer;
use App\Models\CategoriesTopics;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use App\Repositories\Backend\Notifications\NotificationRepository;
use App\Repositories\Backend\Topics\ReplyRepository;
use App\Repositories\Backend\Topics\TopicRepository;
use App\Repositories\Backend\Topics\VoteRepository;
use Auth;
use Gate;
use Illuminate\Http\Request;

class TopicController extends BaseController
{
    protected $topics;
    protected $replies;
    protected $notification;
    protected $vote;
    protected $favorites;

    public function __construct(TopicRepository $topics, ReplyRepository $replies, NotificationRepository $notification, VoteRepository $vote, FavoriteRepository $favorites)
    {
        $this->topics = $topics;
        $this->replies = $replies;
        $this->notification = $notification;
        $this->vote = $vote;
        $this->favorites = $favorites;
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
    {
        "data": [
            {
                "id": 6,
                "category_id": 1,
                "title": "考虑考虑",
                "content": "咯聊几句噢噢噢考虑考虑<img src=\"http://192.168.1.41:8000/uploads/products/2016/11/1303043WwP.png\" alt=\"\"><u>龙年龙门</u>",
                "reply_count": 0,
                "view_count": 0,
                "vote_count": 0,
                "is_excellent": 0,
                "created_at": "2016-11-24 13:03:23",
                "user": {
                    "data": {
                        "id": 3,
                        "username": "来我家",
                        "name": "新英雄",
                        "mobile": "13111111112",
                        "email": "ghsjjshhd",
                        "avatar": {
                            "_default": "http://stone.dev/uploads/avatars/20161117100823_30x30.png",
                            "small": "http://stone.dev/uploads/avatars/20161117100823_30x30_30x30.png",
                            "medium": "http://stone.dev/uploads/avatars/20161117100823_30x30_65x65.png",
                            "large": "http://stone.dev/uploads/avatars/20161117100823_30x30_180x180.png"
                        },
                        "created_at": "2016-11-02 11:01:58"
                    }
                },
                "replies": {
                    "data": []
                }
            },
            {
                "id": 2,
                "category_id": 1,
                "title": "我发布了一个话题",
                "content": "至2013年04月，全国共有34个省级行政区（其中：4个直辖市、23个省、5个自治区、2个特别行政区），333(不含港澳台)个地级行政区划单位（其中：285个地级市、15个地区、30个自治州、3个盟），2856（不含港澳台）个县级行政区划单位（其中：860个市辖区、368个县级市、1453个县、117自治县、49个旗、3个自治旗、1个特区、1个林区），41658（不含港澳台）个乡级行政区划单位（其中：2个区公所、7194个街道、19683个镇、13587个乡、1085个民族乡、106个苏木、1个民族苏木）。662238（不含港澳台）个村级行政单位（包括街道办事处）（省以下行政区划单位统计不包括港澳台）  经常沿用华东、华北、华南、华中、东北、西南、西北七大区的地理分布的说法，具体如下：华北（北京、天津、河北、山西、内蒙古）、华东（上海、山东、江苏、安徽、江西、浙江、福建、台湾）、华中（湖北、湖南、河南）、华南（广东、广西、海南、香港、澳门）、西南（重庆、四川、贵州、云南、西藏）、西北（陕西、甘肃、宁夏、新疆、青海）、东北（黑龙江、吉林、辽宁）（省以下行政区划单位统计不包括台湾） 。",
                "reply_count": 0,
                "view_count": 9,
                "vote_count": 2,
                "is_excellent": 0,
                "created_at": "2016-11-03 03:58:13",
                "user": {
                    "data": {
                        "id": 2,
                        "username": "user",
                        "name": "name",
                        "mobile": "13113113111",
                        "email": "user@user.com",
                        "avatar": {
                            "_default": "",
                            "small": "",
                            "medium": "",
                            "large": ""
                        },
                        "created_at": "2016-11-02 07:57:24"
                    }
                },
                "replies": {
                    "data": []
                }
            },
            {
                "id": 4,
                "category_id": 1,
                "title": "我再发布了一个话题",
                "content": "至2013年04月，全国共有34个省级行政区（其中：4个直辖市、23个省、5个自治区、2个特别行政区），333(不含港澳台)个地级行政区划单位（其中：285个地级市、15个地区、30个自治州、3个盟），2856（不含港澳台）个县级行政区划单位（其中：860个市辖区、368个县级市、1453个县、117自治县、49个旗、3个自治旗、1个特区、1个林区），41658（不含港澳台）个乡级行政区划单位（其中：2个区公所、7194个街道、19683个镇、13587个乡、1085个民族乡、106个苏木、1个民族苏木）。662238（不含港澳台）个村级行政单位（包括街道办事处）（省以下行政区划单位统计不包括港澳台）  经常沿用华东、华北、华南、华中、东北、西南、西北七大区的地理分布的说法，具体如下：华北（北京、天津、河北、山西、内蒙古）、华东（上海、山东、江苏、安徽、江西、浙江、福建、台湾）、华中（湖北、湖南、河南）、华南（广东、广西、海南、香港、澳门）、西南（重庆、四川、贵州、云南、西藏）、西北（陕西、甘肃、宁夏、新疆、青海）、东北（黑龙江、吉林、辽宁）（省以下行政区划单位统计不包括台湾） 。",
                "reply_count": 0,
                "view_count": 0,
                "vote_count": 2,
                "is_excellent": 0,
                "created_at": "2016-11-03 06:01:26",
                "user": {
                    "data": {
                        "id": 45,
                        "username": "Jervis",
                        "name": "纪栋梁",
                        "mobile": "15759268225",
                        "email": "751385816@qq.com",
                        "avatar": {
                            "_default": "http://stone.dev/uploads/avatars/20161123060656.png",
                            "small": "http://stone.dev/uploads/avatars/20161123060656_30x30.png",
                            "medium": "http://stone.dev/uploads/avatars/20161123060656_65x65.png",
                            "large": "http://stone.dev/uploads/avatars/20161123060656_180x180.png"
                        },
                        "created_at": "2016-11-10 18:47:56"
                    }
                },
                "replies": {
                    "data": []
                }
            },
            {
                "id": 3,
                "category_id": 1,
                "title": "我又发布了一个话题",
                "content": "至2013年04月，全国共有34个省级行政区（其中：4个直辖市、23个省、5个自治区、2个特别行政区），333(不含港澳台)个地级行政区划单位（其中：285个地级市、15个地区、30个自治州、3个盟），2856（不含港澳台）个县级行政区划单位（其中：860个市辖区、368个县级市、1453个县、117自治县、49个旗、3个自治旗、1个特区、1个林区），41658（不含港澳台）个乡级行政区划单位（其中：2个区公所、7194个街道、19683个镇、13587个乡、1085个民族乡、106个苏木、1个民族苏木）。662238（不含港澳台）个村级行政单位（包括街道办事处）（省以下行政区划单位统计不包括港澳台）  经常沿用华东、华北、华南、华中、东北、西南、西北七大区的地理分布的说法，具体如下：华北（北京、天津、河北、山西、内蒙古）、华东（上海、山东、江苏、安徽、江西、浙江、福建、台湾）、华中（湖北、湖南、河南）、华南（广东、广西、海南、香港、澳门）、西南（重庆、四川、贵州、云南、西藏）、西北（陕西、甘肃、宁夏、新疆、青海）、东北（黑龙江、吉林、辽宁）（省以下行政区划单位统计不包括台湾） 。",
                "reply_count": 0,
                "view_count": 0,
                "vote_count": 0,
                "is_excellent": 0,
                "created_at": "2016-11-03 05:52:50",
                "user": {
                    "data": {
                        "id": 1,
                        "username": "admin",
                        "name": "管理员",
                        "mobile": "13111111111",
                        "email": "admin@admin.com",
                        "avatar": {
                            "_default": "http://stone.dev/uploads/avatars/20161107085531.png",
                            "small": "http://stone.dev/uploads/avatars/20161107085531_30x30.png",
                            "medium": "http://stone.dev/uploads/avatars/20161107085531_65x65.png",
                            "large": "http://stone.dev/uploads/avatars/20161107085531_180x180.png"
                        },
                        "created_at": "2016-11-02 07:57:24"
                    }
                },
                "replies": {
                    "data": []
                }
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
     * @apiSampleRequest /api/topics/categories/1
     */
    public function index($id, Request $request, Topic $topic)
    {
        $filter = $topic->correctApiFilter($request->get('filters'));
        $topics = $topic->getCategoryTopicsWithFilter($filter, $id);
        return $this->response()->paginator($topics, new TopicTransformer());
    }

    /**
     * @api {get} /users/topics 用户话题列表
     * @apiDescription 用户话题列表 :id 用户ID
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     * @apiSampleRequest /api/users/topics
     */
    public function indexByUser()
    {
        $topics = $this->topics->indexByUser();
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
        $topics = $this->topics->indexByUserId($user_id);
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
        $topics = $this->topics->indexByUserVotes($user_id);
        return $this->response()->paginator($topics, new TopicTransformer());
    }

    /**
     * @api {get} /topics/:id 话题详情
     * @apiDescription 话题详情
     * @apiGroup Topic
     * @apiPermission 认证
     * @apiHeader Authorization Bearer {access_token}
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
            "view_count": 116,
            "vote_count": 29,
            "created_at": "2016-10-31 03:01:39",
            "user": {
                "data": {
                    "id": 3,
                    "username": "来我家",
                    "name": "新英雄",
                    "mobile": "13111111112",
                    "email": "ghsjjshhd",
                    "avatar": {
                        "_default": "http://stone.dev/uploads/avatars/20161117100823_30x30.png",
                        "small": "http://stone.dev/uploads/avatars/20161117100823_30x30_30x30.png",
                        "medium": "http://stone.dev/uploads/avatars/20161117100823_30x30_65x65.png",
                        "large": "http://stone.dev/uploads/avatars/20161117100823_30x30_180x180.png"
                    },
                    "created_at": "2016-11-02 11:01:58"
                }
            },
            "replies": {
                "data": [
                    {
                        "id": 1,
                        "topic_id": 1,
                        "user_id": 3,
                        "content": "<p>您好，这是一条评论。<br>\r\n要删除评论，请先登录，然后再查看这篇文章的评论。登录后您可以看到编辑或者删除评论的选项。</p>",
                        "vote_count": 2,
                        "created_at": "2016-10-31 08:11:43",
                        "replyTo_userid": "",
                        "replyTo_username": "",
                        "user": {
                            "data": {
                                "id": 3,
                                "username": "来我家",
                                "name": "新英雄",
                                "mobile": "13111111112",
                                "email": "ghsjjshhd",
                                "avatar": {
                                    "_default": "http://stone.dev/uploads/avatars/20161117100823_30x30.png",
                                    "small": "http://stone.dev/uploads/avatars/20161117100823_30x30_30x30.png",
                                    "medium": "http://stone.dev/uploads/avatars/20161117100823_30x30_65x65.png",
                                    "large": "http://stone.dev/uploads/avatars/20161117100823_30x30_180x180.png"
                                },
                                "created_at": "2016-11-02 11:01:58"
                            }
                        }
                    },
                    {
                        "id": 2,
                        "topic_id": 1,
                        "user_id": 2,
                        "content": "<p>我是回复给admin的回复内容</p>",
                        "vote_count": 0,
                        "created_at": "2016-10-31 09:31:05",
                        "replyTo_userid": 3,
                        "replyTo_username": "来我家",
                        "user": {
                            "data": {
                                "id": 2,
                                "username": "user",
                                "name": "name",
                                "mobile": "13113113111",
                                "email": "user@user.com",
                                "avatar": {
                                    "_default": "",
                                    "small": "",
                                    "medium": "",
                                    "large": ""
                                },
                                "created_at": "2016-11-02 07:57:24"
                            }
                        }
                    },
                    {
                        "id": 7,
                        "topic_id": 1,
                        "user_id": 2,
                        "content": "我又来回复第一篇文章了",
                        "vote_count": 0,
                        "created_at": "2016-11-07 04:02:13",
                        "replyTo_userid": "",
                        "replyTo_username": "",
                        "user": {
                            "data": {
                                "id": 2,
                                "username": "user",
                                "name": "name",
                                "mobile": "13113113111",
                                "email": "user@user.com",
                                "avatar": {
                                    "_default": "",
                                    "small": "",
                                    "medium": "",
                                    "large": ""
                                },
                                "created_at": "2016-11-02 07:57:24"
                            }
                        }
                    },
                    {
                        "id": 13,
                        "topic_id": 1,
                        "user_id": 2,
                        "content": "我又来回复第一篇文章了",
                        "vote_count": 0,
                        "created_at": "2016-11-11 02:14:47",
                        "replyTo_userid": "",
                        "replyTo_username": "",
                        "user": {
                            "data": {
                                "id": 2,
                                "username": "user",
                                "name": "name",
                                "mobile": "13113113111",
                                "email": "user@user.com",
                                "avatar": {
                                    "_default": "",
                                    "small": "",
                                    "medium": "",
                                    "large": ""
                                },
                                "created_at": "2016-11-02 07:57:24"
                            }
                        }
                    },
                    {
                        "id": 14,
                        "topic_id": 1,
                        "user_id": 2,
                        "content": "我又来回复第一篇文章了",
                        "vote_count": 0,
                        "created_at": "2016-11-11 02:15:46",
                        "replyTo_userid": "",
                        "replyTo_username": "",
                        "user": {
                            "data": {
                                "id": 2,
                                "username": "user",
                                "name": "name",
                                "mobile": "13113113111",
                                "email": "user@user.com",
                                "avatar": {
                                    "_default": "",
                                    "small": "",
                                    "medium": "",
                                    "large": ""
                                },
                                "created_at": "2016-11-02 07:57:24"
                            }
                        }
                    },
                    {
                        "id": 15,
                        "topic_id": 1,
                        "user_id": 2,
                        "content": "我又来回复第一篇文章了",
                        "vote_count": 0,
                        "created_at": "2016-11-11 02:15:55",
                        "replyTo_userid": "",
                        "replyTo_username": "",
                        "user": {
                            "data": {
                                "id": 2,
                                "username": "user",
                                "name": "name",
                                "mobile": "13113113111",
                                "email": "user@user.com",
                                "avatar": {
                                    "_default": "",
                                    "small": "",
                                    "medium": "",
                                    "large": ""
                                },
                                "created_at": "2016-11-02 07:57:24"
                            }
                        }
                    }
                ]
            }
        }
    }
     * @apiSampleRequest /api/topics/1
     */
    public function show(Topic $topic)
    {
        $topic->increment('view_count', 1);
        if (Auth::check()) {
            $topic->is_favorite = $this->favorites->userIsFavorite('topic', $topic->id, Auth::id());
            $topic->is_vote = $this->topics->userIsVoted($topic->id, Auth::id());
        }
        $topic->replies = $topic->replies()->get();
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
        if (!$user->username || !$user->name || !$user->mobile || !$user->email) {
            return $this->response->errorBadRequest('请先完善个人信息！');
        }
        $request->merge(['user_id' => $user->id]);
        $topic = $this->topics->create($request);
        $user->increment('topic_count', 1);
        return $this->response->created(env('APP_URL').'/api/topics/'.$topic->id, $topic);
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

        $this->topics->destroy($topic);
        return $this->response->noContent();
    }

    /**
     * @api {post} /topics/:id/vote 话题点赞
     * @apiDescription 话题点赞 :id
     * @apiGroup Topic
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No Content
     * @apiSampleRequest /api/topics/1/vote
     */
    public function topicVote(Topic $topic)
    {
        //action加入通知的动作
        $topic->action = snake_case(__FUNCTION__);
        $this->vote->create($topic);
        return $this->response->noContent();
    }

    /**
     * @api {post} /topics/:id/favorites 话题收藏
     * @apiDescription 话题收藏
     * @apiGroup Topic
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/topics/1/favorites
     */
    public function favorite(Topic $topic)
    {
        $this->topics->createFavorite($topic);
        return $this->response->created();
    }

    /**
     * @api {get} /topics/:id/replies 话题所有回复
     * @apiDescription 话题所有回复
     * @apiGroup Topic
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
    {
        "data": [
            {
                "id": 1,
                "topic_id": 1,
                "user_id": 1,
                "content": "<p>您好，这是一条评论。<br>\r\n要删除评论，请先登录，然后再查看这篇文章的评论。登录后您可以看到编辑或者删除评论的选项。</p>",
                "created_at": "2016-10-31 16:11:43",
                "updated_at": "2016-10-31 16:47:44",
                "replyTo_userid": "",
                "replyTo_username": "",
                "user": {
                    "data": {
                        "id": 1,
                        "username": "admin",
                        "mobile": "13111111111",
                        "email": "admin@admin.com",
                        "avatar": "http://stone.dev/uploads/avatars/20161107085531.png",
                        "created_at": "2016-11-02 15:57:24"
                    }
                }
            },
            {
                "id": 2,
                "topic_id": 1,
                "user_id": 2,
                "content": "<p>我是回复给admin的回复内容</p>",
                "created_at": "2016-10-31 17:31:05",
                "updated_at": "2016-11-01 10:39:04",
                "replyTo_userid": 1,
                "replyTo_username": "admin",
                "user": {
                    "data": {
                        "id": 2,
                        "username": "user",
                        "mobile": "13113113111",
                        "email": "user@user.com",
                        "avatar": "http://stone.dev/uploads/avatars/default/medium.png",
                        "created_at": "2016-11-02 15:57:24"
                    }
                }
            },
            {
                "id": 7,
                "topic_id": 1,
                "user_id": 2,
                "content": "我又来回复第一篇文章了",
                "created_at": "2016-11-07 12:02:13",
                "updated_at": "2016-11-07 12:02:13",
                "replyTo_userid": "",
                "replyTo_username": "",
                "user": {
                    "data": {
                        "id": 2,
                        "username": "user",
                        "mobile": "13113113111",
                        "email": "user@user.com",
                        "avatar": "http://stone.dev/uploads/avatars/default/medium.png",
                        "created_at": "2016-11-02 15:57:24"
                    }
                }
            }
        ]
    }
     * @apiSampleRequest /api/topics/1/replies
     */
    public function indexTopicsReply(Topic $topic)
    {
        $replies = $this->topics->indexTopicsReply($topic);
        return $this->response->collection($replies, new ReplyTransformer());
    }

    /**
     * @api {post} /topics/:id/replies 话题回复
     * @apiDescription 话题回复 :id
     * @apiGroup Topic
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {Number} parent_id 回复给某条回复 此ID为回复的ID 不回复用户则为0
     * @apiParam {String} content 回复内容
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/topics/1/replies
     */
    public function newReply(Topic $topic, ReplyStoreOrUpdateRequest $request)
    {
        $user = Auth::user();
        //action加入通知的动作
        $request->merge(['user_id' => $user->id, 'topic_id' => $topic->id, 'action' => snake_case(__FUNCTION__)]);
        $this->replies->create($request);
        return $this->response->created();
    }

    /**
     * @api {post} /topics/replies/:id/vote 回复点赞
     * @apiDescription 回复点赞 :id
     * @apiGroup Topic
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No Content
     * @apiSampleRequest /api/topics/replies/1/vote
     */
    public function replyVote(Reply $reply)
    {
        //action加入通知的动作
        $reply->action = snake_case(__FUNCTION__);
        $this->vote->create($reply, 1);
        return $this->response->noContent();
    }



    /**
     * @api {get} /topics/search 话题搜索
     * @apiDescription 话题搜索
     * @apiGroup Topic
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiParam {String} q 搜索关键字
     * @apiParam {Number} categories 话题分类
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     * @apiSampleRequest /api/topics/search
     */
    public function search(Request $request)
    {
        $topics = $this->topics->search($request);
        return $this->response->paginator($topics, new TopicTransformer());
    }
}
