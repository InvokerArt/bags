<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\BannerTransformer;
use App\Api\V1\Transformers\HomeTransformer;
use App\Models\Banners\Image;
use App\Models\Exhibitions\Exhibition;
use App\Models\News\News;

class HomepageController extends BaseController
{

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
                    "banner_id": 1,
                    "title": "我是首页轮播图3",
                    "image_url": "/storage/banners/f53014b75d5d55c2509a462581f49433.png",
                    "link": "",
                    "target": "_blank",
                    "description": "",
                    "order": 9,
                    "published_from": "2016-11-30 04:02:05",
                    "published_to": "2016-11-30 04:02:05",
                    "created_at": "2016-11-11 04:02:05",
                    "updated_at": "2016-11-11 04:02:05",
                    "deleted_at": ""
                },
                {
                    "id": 4,
                    "banner_id": 1,
                    "title": "我是首页轮播",
                    "image_url": "/storage/banners/a766a4fb33a03664caaad1017937f404.png",
                    "link": "",
                    "target": "_blank",
                    "description": "",
                    "order": 4,
                    "published_from": "2016-11-30 11:30:35",
                    "published_to": "2017-01-31 11:30:35",
                    "created_at": "2016-11-01 11:30:35",
                    "updated_at": "2016-11-01 11:30:35",
                    "deleted_at": ""
                },
                {
                    "id": 3,
                    "banner_id": 1,
                    "title": "我是首页轮播",
                    "image_url": "/storage/banners/f53014b75d5d55c2509a462581f49433.png",
                    "link": "",
                    "target": "_blank",
                    "description": "",
                    "order": 3,
                    "published_from": "2016-11-30 11:30:15",
                    "published_to": "2016-12-31 11:30:15",
                    "created_at": "2016-11-01 11:30:15",
                    "updated_at": "2016-11-01 11:30:15",
                    "deleted_at": ""
                }
            ],
            "news": {
                "id": 13,
                "user_id": 1,
                "slug": "",
                "title": "基于RESTful API 怎么设计用户权限控制？",
                "subtitle": "有人说，每个人都是平等的；\r\n也有人说，人生来就是不平等的；\r\n在人类社会中，并没有绝对的公平，\r\n一件事，并不是所有人都能去做；\r\n一样物，并不是所有人都能够拥有。",
                "content": "<h2>前言</h2><p>有人说，每个人都是平等的；<br/>也有人说，人生来就是不平等的；<br/>在人类社会中，并没有绝对的公平，<br/>一件事，并不是所有人都能去做；<br/>一样物，并不是所有人都能够拥有。<br/>每个人都有自己的角色，每种角色都有对某种资源的一定权利，或许是拥有，或许只能是远观而不可亵玩。<br/>把这种人类社会中如此抽象的事实，提取出来，然后写成程序，还原本质的工作，就是我们程序员该做的事了。<br/>有了一个这么有范儿的开头，下面便来谈谈基于RESTful，如何实现不同的人不同的角色对于不同的资源不同的操作的权限控制。</p><h2>RESTful简述</h2><p>本文是基于RESTful描述的，需要你对这个有初步的了解。<br/>RESTful是什么？<br/><strong>Representational State Transfer</strong>，简称<strong>REST</strong>，是Roy Fielding博士在2000年他的博士论文中提出来的一种软件架构风格。<br/>REST比较重要的点是<strong>资源</strong>和<strong>状态转换</strong>，<br/>所谓&quot;<strong>资源</strong>&quot;，就是网络上的一个实体，或者说是网络上的一个具体信息。它可以是一段文本、一张图片、一首歌曲、一种服务，总之就是一个具体的实在。<br/>而<strong>&quot;状态转换&quot;</strong>，则是把对应的HTTP协议里面，四个表示操作方式的动词分别对应四种基本操作：</p><ol class=\" list-paddingleft-2\"><li><p>GET，用来浏览(browse)资源</p></li><li><p>POST，用来新建(create)资源</p></li><li><p>PUT，用来更新(update)资源</p></li><li><p>DELETE，用来删除(delete)资源。</p></li></ol><p><img src=\"http://upload-images.jianshu.io/upload_images/79702-6fa6d3fb7d0fcc61.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240/format/jpg\" data-original-src=\"http://upload-images.jianshu.io/upload_images/79702-6fa6d3fb7d0fcc61.png?imageMogr2/auto-orient/strip%7CimageView2/2/format/jpg\" class=\"imagebubble-image\"/><br/></p><p>RESTful CURD</p><h2>资源的分类及操作</h2><p>清楚了资源的概念，然后再来对资源进行一下分类，我把资源分为下面三类：</p><ol class=\" list-paddingleft-2\"><li><p>私人资源 (Personal Source)</p></li><li><p>角色资源 (Roles Source)</p></li><li><p>公共资源 (Public Source)</p></li></ol><p><img src=\"http://upload-images.jianshu.io/upload_images/79702-5a84ec87887e839b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240/format/jpg\" data-original-src=\"http://upload-images.jianshu.io/upload_images/79702-5a84ec87887e839b.png?imageMogr2/auto-orient/strip%7CimageView2/2/format/jpg\" class=\"imagebubble-image\"/><br/></p><p>Sources</p><p><strong>&quot;私人资源&quot;</strong>：是属于某一个用户所有的资源，只有用户本人才能操作，其他用户不能操作。例如用户的个人信息、订单、收货地址等等。<br/><strong>&quot;角色资源&quot;</strong>：与私人资源不同，角色资源范畴更大，一个角色可以对应多个人，也就是一群人。如果给某角色分配了权限，那么只有身为该角色的用户才能拥有这些权限。例如系统资源只能够管理员操作，一般用户不能操作。<br/><strong>&quot;公共资源&quot;</strong>：所有人无论角色都能够访问并操作的资源。</p><p>而对资源的操作，无非就是分为四种：</p><ol class=\" list-paddingleft-2\"><li><p>浏览 (browse)</p></li><li><p>新增 (create)</p></li><li><p>更新 (update)</p></li><li><p>删除 (delete)</p></li></ol><h2>角色、用户、权限之间的关系</h2><p>角色和用户的概念，自不用多说，大家都懂，但是权限的概念需要提一提。<br/><strong>&quot;权限&quot;</strong>，就是资源与操作的一套组合，例如&quot;增加用户&quot;是一种权限，&quot;删除用户&quot;是一种权限，所以对于一种资源所对应的权限有且只有四种。</p><p><img src=\"http://upload-images.jianshu.io/upload_images/79702-0f43f4519f13df37.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240/format/jpg\" data-original-src=\"http://upload-images.jianshu.io/upload_images/79702-0f43f4519f13df37.png?imageMogr2/auto-orient/strip%7CimageView2/2/format/jpg\" class=\"imagebubble-image\"/><br/></p><p>Permissions</p><p><strong>角色</strong>与<strong>用户</strong>的关系：一个角色对应一群用户，一个用户也可以扮演多个角色，所以它们是多对多的关系。<br/><strong>角色</strong>与<strong>权限</strong>的关系：一个角色拥有一堆权限，一个权限却只能属于一个角色，所以它们是一(角色)对多(权限)的关系<br/><strong>权限</strong>与<strong>用户</strong>的关系：由于一个用户可以扮演多个角色，一个角色拥有多个权限，所以用户与权限是间接的多对多关系。</p><p><img src=\"http://upload-images.jianshu.io/upload_images/79702-6d71d7165f237b6b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240/format/jpg\" data-original-src=\"http://upload-images.jianshu.io/upload_images/79702-6d71d7165f237b6b.png?imageMogr2/auto-orient/strip%7CimageView2/2/format/jpg\" class=\"imagebubble-image\"/><br/></p><p>Relations</p><p>需要注意两种特别情况：</p><ol class=\" list-paddingleft-2\"><li><p>私人资源与用户的关系，一种私人资源对应的四种权限只能属于一个用户，所以这种情况下，用户和权限是一(用户)对多(权限)的关系。</p></li><li><p>超级管理员的角色，这个角色是神一般的存在，能无视一切阻碍，对所有资源拥有绝对权限，甭管你是私人资源还是角色资源。</p></li></ol><h2>数据库表的设计</h2><p>角色、用户、权限的模型应该怎么样设计，才能满足它们之间的关系？</p><p><img src=\"http://upload-images.jianshu.io/upload_images/79702-b40a1b325d6539f0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240/format/jpg\" data-original-src=\"http://upload-images.jianshu.io/upload_images/79702-b40a1b325d6539f0.png?imageMogr2/auto-orient/strip%7CimageView2/2/format/jpg\" class=\"imagebubble-image\"/><br/></p><p>Models</p><p>对上图的一些关键字段进行说明：</p><h6>Source</h6><ul class=\" list-paddingleft-2\"><li><p>name: 资源的名称，也就是其他模型的名称，例如：user、role等等。</p></li><li><p>identity: 资源的唯一标识，可以像uuid，shortid这些字符串，也可以是model的名称。</p></li><li><p>permissions : 一种资源对应有四种权限，分别对这种资源的browse、create、update、delete</p></li></ul><h6>Permission</h6><ul class=\" list-paddingleft-2\"><li><p>source : 该权限对应的资源，也就是Source的某一条记录的唯一标识</p></li><li><p>action ：对应资源的操作，只能是browse、create、update、delete四个之一</p></li><li><p>relation：用来标记该权限是属于私人的，还是角色的，用于OwnerPolicy检测</p></li><li><p>roles: 拥有该权限的角色</p></li></ul><h6>Role</h6><ul class=\" list-paddingleft-2\"><li><p>users : 角色所对应的用户群，一个角色可以对应多个用户</p></li><li><p>permissions: 权限列表，一个角色拥有多项权利</p></li></ul><h6>User</h6><ul class=\" list-paddingleft-2\"><li><p>createBy : 该记录的拥有者，在user标里，一般等于该记录的唯一标识，这一属性用于OwnerPolicy的检测，其他私有资源的模型设计，也需要加上这一字段来标识资源的拥有者。</p></li><li><p>roles : 用户所拥有的角色</p></li></ul><h2>策略/过滤器</h2><p>在sails下称为策略(Policy)，在java SSH下称为过滤器(Filter)，无论名称如何，他们工作原理是大同小异的，主要是在一条HTTP请求访问一个Controller下的action之前进行检测。所以在这一层，我们可以自定义一些策略/过滤器来实现权限控制。<br/>为行文方便，下面姑且允许我使用策略这一词。</p><p><strong>策略 (Policy) </strong></p><blockquote><p>下面排版顺序对应Policy的运行顺序</p></blockquote><ol class=\" list-paddingleft-2\"><li><p><strong>SessionAuthPolicy</strong>：<br/>检测用户是否已经登录，用户登录是进行下面检测的前提。</p></li><li><p><strong>SourcePolicy</strong>：<br/>检测访问的资源是否存在，主要检测Source表的记录</p></li><li><p><strong>PermissionPolicy</strong>：<br/>检测该用户所属的角色，是否有对所访问资源进行对应操作的权限。</p></li><li><p><strong>OwnerPolicy</strong>：<br/>如果所访问的资源属于私人资源，则检测当前用户是否该资源的拥有者。</p></li></ol><p>如果通过所有policy的检测，则把请求转发到目标action。</p><p><img src=\"http://upload-images.jianshu.io/upload_images/79702-5cceb464871c63f3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240/format/jpg\" data-original-src=\"http://upload-images.jianshu.io/upload_images/79702-5cceb464871c63f3.png?imageMogr2/auto-orient/strip%7CimageView2/2/format/jpg\" class=\"imagebubble-image\"/><br/></p><p>Policies</p><h2>Sails下的权限控制实现</h2><p>在Sails下，有一个很方便的套件<a href=\"https://github.com/tjwebb/sails-permissions\" target=\"_blank\">sails-permissions</a>，集成了一套权限管理的方案，本文也是基于该套件的源码所引出来的权限管理解决方案。</p><h2>结语</h2><p>对程序员最大的挑战，并不是能否掌握了哪些编程语言，哪些软件框架，而是对业务和需求的理解，然后在此基础上，把要点抽象出来，写成计算机能理解的语言。<br/>最后，希望这篇文章，能够帮助你对权限管理这一课题增加多一点点理解。</p><p><br/><br/></p><p>文／JC_Huang（简书作者）<br/>原文链接：http://www.jianshu.com/p/db65cf48c111<br/>著作权归作者所有，转载请联系作者获得授权，并标注“简书作者”。</p><p><br/></p>",
                "image": "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg",
                "view_count": 29,
                "comment_count": 0,
                "is_excellent": "yes",
                "is_top": "no",
                "status": 1,
                "published_at": "2016-11-02 15:57:23",
                "created_at": "2016-11-02 15:57:23",
                "updated_at": "2016-11-14 06:45:31",
                "deleted_at": "",
                "categories": [
                    {
                        "id": 1,
                        "parent_id": "",
                        "lft": 1,
                        "rgt": 2,
                        "depth": "",
                        "name": "可降解知识",
                        "is_active": 1,
                        "slug": "",
                        "description": "",
                        "meta_title": "",
                        "meta_keywords": "",
                        "meta_description": "",
                        "created_at": "2016-10-28 16:01:50",
                        "updated_at": "2016-10-28 16:01:50",
                        "pivot": {
                            "news_id": 13,
                            "category_id": 1
                        }
                    },
                    {
                        "id": 2,
                        "parent_id": "",
                        "lft": 3,
                        "rgt": 4,
                        "depth": "",
                        "name": "高分子知识",
                        "is_active": 1,
                        "slug": "",
                        "description": "",
                        "meta_title": "",
                        "meta_keywords": "",
                        "meta_description": "",
                        "created_at": "2016-10-28 16:01:50",
                        "updated_at": "2016-10-28 16:01:50",
                        "pivot": {
                            "news_id": 13,
                            "category_id": 2
                        }
                    },
                    {
                        "id": 3,
                        "parent_id": "",
                        "lft": 5,
                        "rgt": 6,
                        "depth": "",
                        "name": "国内市场动态",
                        "is_active": 1,
                        "slug": "",
                        "description": "",
                        "meta_title": "",
                        "meta_keywords": "",
                        "meta_description": "",
                        "created_at": "2016-10-28 16:01:50",
                        "updated_at": "2016-10-28 16:01:50",
                        "pivot": {
                            "news_id": 13,
                            "category_id": 3
                        }
                    }
                ]
            },
            "exhibition": {
                "id": 1,
                "user_id": 1,
                "title": "有一个展会",
                "slug": "",
                "subtitle": "展会简单描述",
                "address": "xiamen",
                "telephone": "05925910000",
                "content": "<h2 style=\"box-sizing: border-box; -webkit-font-smoothing: antialiased; font-size: 30px; font-weight: 400; margin-top: 55px; position: relative; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\"><a href=\"http://docs.larastars.cn/zh/5.3/routing#route-model-binding\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(82, 82, 82); text-decoration: none;\">路由模型绑定</a></h2><p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\">当注入模型的 ID 到路由或控制器动作时，你经常会需要查询检索出相应 ID 的模型。Laravel 路由模型绑定提供了一种便利的方式去注入模型实例到路由中，比如，你可以通过传递 ID，来注入匹配 ID 的用户的整个模型实例到路由中。</p><p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\"><a style=\"box-sizing: border-box; background-color: transparent; color: rgb(244, 100, 95); text-decoration: underline;\" name=\"implicit-binding\"></a></p><h3 style=\"box-sizing: border-box; -webkit-font-smoothing: antialiased; font-size: 24px; font-weight: 400; margin-top: 45px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\">隐式绑定</h3><p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\">Laravel 会自动的解析定义在路由或者控制器中具有类型提示的&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" background:=\"\" color:=\"\" padding:=\"\" 1px=\"\" border-radius:=\"\" text-shadow:=\"\" white=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">Eloquent</code>&nbsp;模型，它会根据变量名与参数名匹配，比如&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" background:=\"\" color:=\"\" padding:=\"\" 1px=\"\" border-radius:=\"\" text-shadow:=\"\" white=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">api<span class=\"token operator\" style=\"box-sizing: border-box; color: rgb(85, 85, 85);\">/</span>users<span class=\"token operator\" style=\"box-sizing: border-box; color: rgb(85, 85, 85);\">/</span><span class=\"token punctuation\" style=\"box-sizing: border-box; color: rgb(153, 153, 153);\">{</span>user<span class=\"token punctuation\" style=\"box-sizing: border-box; color: rgb(153, 153, 153);\">}</span></code>&nbsp;匹配&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" background:=\"\" color:=\"\" padding:=\"\" 1px=\"\" border-radius:=\"\" text-shadow:=\"\" white=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token variable\" style=\"box-sizing: border-box; color: rgb(78, 161, 223);\">$user</span></code>&nbsp;变量：</p><pre class=\" language-php\" style=\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" text-shadow:=\"\" white=\"\" 0px=\"\" direction:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" padding:=\"\" margin-top:=\"\" margin-bottom:=\"\" background-color:=\"\" border-radius:=\"\" box-shadow:=\"\" 1px=\"\" vertical-align:=\"\">Route::get(&#39;api/users/{user}&#39;,&nbsp;function&nbsp;(App\\User&nbsp;$user)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$user-&gt;email;});</pre><p><br/></p>",
                "image": "/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg",
                "view_count": 14,
                "is_excellent": "yes",
                "is_top": "no",
                "status": 1,
                "published_at": "2016-11-30 17:30:52",
                "created_at": "2016-11-01 17:32:43",
                "updated_at": "2016-11-14 06:45:39",
                "deleted_at": ""
            }
        }
    }
     * @apiSampleRequest /api/home
     */
    public function index()
    {
        $homeData['data']['banners'] = Image::where('banner_id', 1)->orderBy('order', 'desc')->get()->toArray();
        $homeData['data']['news'] = News::where('is_excellent', 'yes')->with('categories')->first()->toArray();
        $homeData['data']['exhibition'] = Exhibition::where('is_excellent', 'yes')->first()->toArray();
        $homeData = formatArray($homeData);
        return $this->response->array($homeData);
    }
}
