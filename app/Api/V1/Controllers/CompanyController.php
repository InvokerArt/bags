<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\CertificationStoreRequest;
use App\Api\V1\Requests\CompanyStoreRequest;
use App\Api\V1\Requests\JobStoreRequest;
use App\Api\V1\Requests\JoinStoreRequest;
use App\Api\V1\Transformers\BannerTransformer;
use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\CertificationTransformer;
use App\Api\V1\Transformers\CompanyShowTransformer;
use App\Api\V1\Transformers\CompanyTransformer;
use App\Api\V1\Transformers\CompanyUpdateTransformer;
use App\Api\V1\Transformers\JobTransformer;
use App\Api\V1\Transformers\JoinAndValidateTransformer;
use App\Api\V1\Transformers\JoinTransformer;
use App\Api\V1\Transformers\ProductShowTransformer;
use App\Api\V1\Transformers\ProductTransformer;
use App\Models\Area;
use App\Models\CategoryCompany;
use App\Models\Certification;
use App\Models\Company;
use App\Models\Image;
use App\Models\Job;
use App\Models\Join;
use App\Models\Product;
use App\Repositories\Backend\Banners\ImageInterface;
use App\Repositories\Backend\Certifications\CertificationInterface;
use App\Repositories\Backend\Companies\CompanyInterface;
use App\Repositories\Backend\Jobs\JobInterface;
use App\Repositories\Backend\Joins\JoinInterface;
use Auth;
use Illuminate\Http\Request;
use Validator;

class CompanyController extends BaseController
{
    protected $joins;
    protected $certifications;
    protected $companies;
    private $job;
    private $image;

    public function __construct(JoinInterface $joins, CertificationInterface $certifications, CompanyInterface $companies, JobInterface $job, ImageInterface $image)
    {
        $this->joins = $joins;
        $this->certifications = $certifications;
        $this->companies = $companies;
        $this->job = $job;
        $this->image = $image;
    }

    /**
     * @apiDefine Company 公司
     */

    /**
     * @api {get} /companies/banner 公司轮播图
     * @apiDescription 公司轮播图
     * @apiGroup Company
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 7,
                "title": "我是招商加盟轮播1",
                "image_url": "/storage/banners/f53014b75d5d55c2509a462581f49433.png",
                "order": 7,
                "link": "",
                "published_from": "2016-11-30 17:49:05",
                "published_to": "2016-12-31 17:49:05"
            },
            {
                "id": 8,
                "title": "我是招商加盟轮播2",
                "image_url": "/storage/banners/a766a4fb33a03664caaad1017937f404.png",
                "order": 8,
                "link": "",
                "published_from": "2016-11-30 17:49:26",
                "published_to": "2016-12-31 17:49:26"
            }
        ]
    }
     * @apiSampleRequest /api/companies/banner
     */
    public function banner()
    {
        $images = $this->image->getCategoryBanners(2);
        return $this->response->collection($images, new BannerTransformer());
    }

    /**
     * @api {get} /companies/role/:id 公司列表
     * @apiDescription 公司列表:id代表的身份见顶部(接口说明)
     * @apiGroup Company
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccess is_validate 认证 1//已认证  0//未认证
     * @apiSuccess is_excellent 推广 1//已认证  0//未认证
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "name": "航运城",
                "province": "福建省",
                "city": "厦门市",
                "area": "思明区",
                "addressDetail": "软件园二期24号之二306B",
                "telephone": "0592-5928529",
                "photos": [
                    "/storage/companies/2016/11/192246tXXv.png",
                    "/storage/companies/2016/11/192247z703.png"
                ],
                "is_validate": 0,
                "is_excellent": 0
            }
        ],
        "meta": {
            "pagination": {
                "total": 1,
                "count": 1,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
     * @apiSampleRequest /api/companies/role/1
     */
    public function index($id)
    {
        if ($id) {
            $companys = Company::where('role', $id)->with(['certifications' => function ($query) {
                $query->validate();
            }])->orderBy('created_at', 'DESC')->paginate();
        } else {
            $companys = Company::where('role', 1)->orWhere('role', 2)->with(['certifications' => function ($query) {
                $query->validate();
            }])->orderBy('created_at', 'DESC')->paginate();
        }
        return $this->response()->paginator($companys, new CompanyTransformer());
    }

    /**
     * @api {get} /companies/categories/:id 公司分类
     * @apiDescription 公司分类 :id //1为采购商 //2为供应商 //3为机构/单位
     * @apiGroup Company
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "name": "垃圾袋"
            },
            {
                "id": 2,
                "name": "背心袋"
            },
            {
                "id": 3,
                "name": "连卷袋"
            },
            {
                "id": 4,
                "name": "地膜"
            },
            {
                "id": 5,
                "name": "阻隔膜"
            },
            {
                "id": 6,
                "name": "快递袋"
            },
            {
                "id": 7,
                "name": "边封袋"
            },
            {
                "id": 8,
                "name": "其他"
            }
        ]
    }
     * @apiSampleRequest /api/companies/categories/1
     */
    public function categories($id)
    {
        //激活的分类
        $categories = CategoryCompany::where('is_active', 1)->where('role', $id)->get();
        return $this->response()->collection($categories, new CategoryTransformer());
    }

    /**
     * @api {get} /companies/:id 公司详情
     * @apiDescription 公司详情 :id 公司ID categories为分类数据 products 为产品数据 unit代表的单位见顶部(接口说明)
     * @apiGroup Company
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *  {
            "data": {
                "id": 1,
                "name": "航运城",
                "address": "福建厦门思明",
                "telephone": "0592-5928529",
                "content": "<p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\">Next, define a route that contains a&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token punctuation\" style=\"box-sizing: border-box; color: rgb(153, 153, 153);\">{</span>user<span class=\"token punctuation\" style=\"box-sizing: border-box; color: rgb(153, 153, 153);\">}</span></code>&nbsp;parameter:</p><pre class=\" language-php\" style=\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" margin-top:=\"\" margin-bottom:=\"\" background-color:=\"\" border-radius:=\"\" padding:=\"\" box-shadow:=\"\" 1px=\"\" vertical-align:=\"\">$router-&gt;get(&#39;profile/{user}&#39;,&nbsp;function(App\\User&nbsp;$user)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;//});</pre><p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\">Since we have bound all&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token punctuation\" style=\"box-sizing: border-box; color: rgb(153, 153, 153);\">{</span>user<span class=\"token punctuation\" style=\"box-sizing: border-box; color: rgb(153, 153, 153);\">}</span></code>&nbsp;parameters to the&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">App\\<span class=\"token package\" style=\"box-sizing: border-box;\">User</span></code>&nbsp;model, a&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">User</code>&nbsp;instance will be injected into the route. So, for example, a request to&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">profile<span class=\"token operator\" style=\"box-sizing: border-box; color: rgb(85, 85, 85);\">/</span><span class=\"token number\" style=\"box-sizing: border-box; color: rgb(218, 86, 74);\">1</span></code>&nbsp;will inject the&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">User</code>&nbsp;instance from the database which has an ID of&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token number\" style=\"box-sizing: border-box; color: rgb(218, 86, 74);\">1</span></code>.</p><p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\">If a matching model instance is not found in the database, a 404 HTTP response will be automatically generated.</p><h4 style=\"box-sizing: border-box; -webkit-font-smoothing: antialiased; margin-top: 35px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\">Customizing The Resolution Logic</h4><p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\">If you wish to use your own resolution logic, you may use the&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token scope\" style=\"box-sizing: border-box; color: rgb(218, 86, 74);\">Route<span class=\"token punctuation\" style=\"box-sizing: border-box; color: rgb(153, 153, 153);\">::</span></span>bind</code>&nbsp;method. The&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">Closure</code>you pass to the&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">bind</code>&nbsp;method will receive the value of the URI segment and should return the instance of the class that should be injected into the route:</p><pre class=\" language-php\" style=\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" margin-top:=\"\" margin-bottom:=\"\" background-color:=\"\" border-radius:=\"\" padding:=\"\" box-shadow:=\"\" 1px=\"\" vertical-align:=\"\">$router-&gt;bind(&#39;user&#39;,&nbsp;function&nbsp;($value)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;App\\User::where(&#39;name&#39;,&nbsp;$value)-&gt;first();});</pre><p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\"><a style=\"box-sizing: border-box; color: rgb(244, 100, 95); text-decoration: underline; background-color: transparent;\" name=\"form-method-spoofing\"></a></p><h2 style=\"box-sizing: border-box; -webkit-font-smoothing: antialiased; font-size: 30px; font-weight: 400; margin-top: 55px; position: relative; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\"><a href=\"https://laravel.com/docs/5.3/routing#form-method-spoofing\" style=\"box-sizing: border-box; color: rgb(82, 82, 82); text-decoration: none; background-color: transparent;\">Form Method Spoofing</a></h2><p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\">HTML forms do not support&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token constant\" style=\"box-sizing: border-box; color: rgb(218, 86, 74);\">PUT</span></code>,&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token constant\" style=\"box-sizing: border-box; color: rgb(218, 86, 74);\">PATCH</span></code>&nbsp;or&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token constant\" style=\"box-sizing: border-box; color: rgb(218, 86, 74);\">DELETE</span></code>&nbsp;actions. So, when defining&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token constant\" style=\"box-sizing: border-box; color: rgb(218, 86, 74);\">PUT</span></code>,&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token constant\" style=\"box-sizing: border-box; color: rgb(218, 86, 74);\">PATCH</span></code>&nbsp;or&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\"><span class=\"token constant\" style=\"box-sizing: border-box; color: rgb(218, 86, 74);\">DELETE</span></code>&nbsp;routes that are called from an HTML form, you will need to add a hidden&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">_method</code>&nbsp;field to the form. The value sent with the&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">_method</code>&nbsp;field will be used as the HTTP request method:</p><pre class=\" language-php\" style=\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" margin-top:=\"\" margin-bottom:=\"\" background-color:=\"\" border-radius:=\"\" padding:=\"\" box-shadow:=\"\" 1px=\"\" vertical-align:=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/></pre><p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\">You may use the&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">method_field</code>&nbsp;helper to generate the&nbsp;<code class=\" language-php\" style=\"box-sizing: border-box; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" color:=\"\" border-radius:=\"\" background:=\"\" padding:=\"\" 1px=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" white-space:=\"\" word-spacing:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" box-shadow:=\"\" vertical-align:=\"\">_method</code>&nbsp;input:</p><pre class=\" language-php\" style=\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \" andale=\"\" font-size:=\"\" text-shadow:=\"\" 0px=\"\" direction:=\"\" word-break:=\"\" line-height:=\"\" tab-size:=\"\" margin-top:=\"\" margin-bottom:=\"\" background-color:=\"\" border-radius:=\"\" padding:=\"\" box-shadow:=\"\" 1px=\"\" vertical-align:=\"\">{{&nbsp;method_field(&#39;PUT&#39;)&nbsp;}}</pre><p style=\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\"><a style=\"box-sizing: border-box; color: rgb(244, 100, 95); text-decoration: underline; background-color: transparent;\" name=\"accessing-the-current-route\"></a></p><h2 style=\"box-sizing: border-box; -webkit-font-smoothing: antialiased; font-size: 30px; font-weight: 400; margin-top: 55px; position: relative; color: rgb(82, 82, 82); font-family: \" source=\"\" sans=\"\" white-space:=\"\" background-color:=\"\"><a href=\"https://laravel.com/docs/5.3/routing#accessing-the-current-route\" style=\"box-sizing: border-box; color: rgb(82, 82, 82); text-decoration: none; background-color: transparent;\">Accessing The Current Route</a></h2><p><br/></p>",
                "photos": [
                    "/storage/companies/2016/11/192246tXXv.png",
                    "/storage/companies/2016/11/192247z703.png"
                ],
                "created_at": "2016-11-01 18:22:53",
                "categories": {
                    "data": [
                        {
                            "id": 17,
                            "name": "环保塑料行业协会"
                        },
                        {
                            "id": 19,
                            "name": "政府机关"
                        },
                        {
                            "id": 20,
                            "name": "其他"
                        }
                    ]
                },
                "jobs": {
                    "data": [
                        {
                            "id": 1,
                            "job": "销售代表",
                            "total": "10人",
                            "education": "本科大学",
                            "experience": "2-3年",
                            "minsalary": "50000",
                            "content": "<p>要求就是不要命</p>"
                        }
                    ]
                },
                "products": {
                    "data": [
                        {
                            "id": 1,
                            "title": "产品标题",
                            "price": 1.2,
                            "unit": 1,
                            "content": "<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>",
                            "images": [
                                "/uploads/products/2016/11/092739rqKq.png"
                            ]
                        }
                    ]
                }
            }
        }
     * @apiSampleRequest /api/companies/1
     */
    public function show(Company $company)
    {
        $company->increment('view_count', 1);
        $company->categories = $company->categories()->get();
        $user = $company->user()->first();
        $company->products = $user->products()->get();
        $company->jobs = $user->jobs()->paginate();
        return $this->response->item($company, new CompanyShowTransformer());
    }

    /**
     * @api {get} /companies/jobs 公司招聘
     * @apiDescription 公司招聘
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *
    {
        "data": [
            {
                "id": 1,
                "job": "销售代表",
                "total": "10人",
                "education": "本科大学",
                "experience": "2-3年",
                "minsalary": "50000",
                "content": "<p>要求就是不要命</p>"
            }
        ]
    }

    没有招聘内容的时候为
    {
        "data": []
    }
     * @apiSampleRequest /api/companies/jobs
     */
    public function job(Request $request)
    {
        $user = $request->user();
        $jobs = $user->jobs()->orderBy('created_at', 'DESC')->paginate();
        return $this->response->paginator($jobs, new JobTransformer());
    }

    /**
     * @api {post} /companies/jobs 发布招聘
     * @apiDescription 发布招聘
     * @apiGroup Company
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String} job 招聘职位
     * @apiParam {String} total 招聘人数
     * @apiParam {String} education 学历要求
     * @apiParam {String} experience 工作年限
     * @apiParam {String} minsalary 薪资待遇
     * @apiParam {String} content 招聘内容
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     *
     * @apiSampleRequest /api/companies/jobs
     */
    public function jobStore(JobStoreRequest $request)
    {
        $user = $request->user();
        $request->merge(['user_id' => $user->id]);
        $job = $this->job->create($request);
        return $this->response->created();
    }

    /**
     * @api {get} /companies/products 产品列表
     * @apiDescription 产品列表 unit代表的单位见顶部(接口说明)
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *
    {
        "data": [
            {
                "id": 2,
                "title": "我有袋子100箱",
                "price": 100,
                "unit": 5,
                "content": "<p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">加工定制 是</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">用途 通用包装</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">底面侧面 无底无侧</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">供货类型 可定制</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">规格 400*300（mm*mm）</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">加印LOGO 可以</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">款式 手提袋</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">颜色 米白</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">印刷工艺 丝印</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">自重 285（g）</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">品牌 Martina</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">是否有现货 有</p><p><br/></p>",
                "images": [
                    "http://stone.dev/uploads/products/2016/11/165204E76X.png"
                ]
            }
        ],
        "meta": {
            "pagination": {
                "total": 1,
                "count": 1,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
    没有产品内容的时候为
    {
        "data": []
    }
     * @apiSampleRequest /api/companies/products
     */
    public function product(Request $request)
    {
        $user = $request->user();
        $products = $user->products()->paginate();
        return $this->response->paginator($products, new ProductTransformer());
    }

    /**
     * @api {get} /companies/:id/join-certification 公司加盟或机构认证
     * @apiDescription 公司加盟或机构认证 :id 公司ID user 申请者用户信息 company 申请者公司信息
     * @apiGroup Company
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "id": 1,
            "name": "航运城",
            "address": "福建省厦门市思明区",
            "telephone": "0592-5928529",
            "notes": "加盟须知就是你看了必须加盟",
            "image": [
                "/storage/companies/2016/11/192246tXXv.png",
                "/storage/companies/2016/11/192247z703.png"
            ],
            "user": {
                "data": {
                    "id": 1,
                    "username": "admin",
                    "mobile": "13111111111",
                    "email": "admin@admin.com",
                    "avatar": "http://stone.dev/uploads/avatars/default/medium.png",
                    "created_at": "2016-11-02 15:57:24"
                }
            },
            "company": {
                "data": {
                    "id": 3,
                    "name": "测试公司",
                    "address": "北京市北京市石景山区",
                    "telephone": "0592-5928529",
                    "photos": [
                        "/storage/companies/2016/11/192330UhMQ.png"
                    ]
                }
            }
        }
    }
     * @apiSampleRequest /api/companies/1/join-certification
     */
    public function joinAndValidate(Company $company, Request $request)
    {
        $company->company = Auth::user()->company()->first();
        $company->user = Auth::user();
        return $this->response->item($company, new JoinAndValidateTransformer());
    }

    /**
     * @api {post} /companies/:id/joins 申请加盟
     * @apiDescription 申请加盟:id 公司ID
     * @apiGroup Company
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String[]} identity_card[] 身份证
     * @apiParam {String[]} licenses[] 营业执照
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/companies/1/joins
     */
    public function joinCompany(Company $company, JoinStoreRequest $request)
    {
        $user = Auth::user();
        //action加入通知的动作
        $request->merge(['user_id' => $user->id, 'company_id' => $company->id, 'action' => snake_case(__FUNCTION__)]);
        $this->joins->create($request);
        return $this->response->created();
    }

    /**
     * @api {patch} /joins/:id 加盟审核
     * @apiDescription 加盟审核
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {Number{0,1,2}} status 审核状态
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     * @apiSampleRequest /api/joins/1
     */
    public function join(Join $join, Request $request)
    {
        $this->joins->update($join, $request);
        return $this->response->item($join, new JoinTransformer());
    }

    /**
     * @api {post} /companies/:id/certifications 申请认证
     * @apiDescription 申请认证:id 公司ID
     * @apiGroup Company
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String[]} identity_card[] 身份证
     * @apiParam {String[]} licenses[] 营业执照
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/companies/1/certifications
     */
    public function certificationCompany(Company $company, CertificationStoreRequest $request)
    {
        $user = Auth::user();
        //action加入通知的动作
        $request->merge(['user_id' => $user->id, 'company_id' => $company->id, 'action' => snake_case(__FUNCTION__)]);
        $this->certifications->create($request);
        return $this->response->created();
    }

    /**
     * @api {patch} /certifications/:id 认证审核
     * @apiDescription 认证审核
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {Number{0,1,2}} status 审核状态
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     * @apiSampleRequest /api/certifications/1
     */
    public function certification(Certification $certification, Request $request)
    {
        $this->certifications->update($certification, $request);
        return $this->response->item($certification, new CertificationTransformer());
    }

    /**
     * @api {post} /companies/ 创建公司
     * @apiDescription 创建公司
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {Number{1,2,3}} role 身份
     * @apiParam {String} name 公司名
     * @apiParam {String} telephone 电话
     * @apiParam {Number} address 地区code
     * @apiParam {String} addressDetail 详细地区
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/companies
     */
    public function store(CompanyStoreRequest $request)
    {
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);
        $messages = [
            'user_id.unique' => '请勿重复创建公司！',
            'name.unique' => '公司名已存在！',
        ];
        $validator = Validator::make($request->all(), ['user_id' => 'required|unique:companies', 'name' => 'required|unique:companies'], $messages);
        if ($validator->fails()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('422 Unprocessable Entity', $validator->errors());
        }
        $this->companies->create($request);
        return $this->response->created();
    }

    /**
     * @api {PATCH} /companies 更新公司信息
     * @apiDescription 更新公司时下面参数不是必传项
     * @apiGroup Auth
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {Number{1,2,3}} role 身份
     * @apiParam {String} name 公司名或单位名
     * @apiParam {String} telephone 电话
     * @apiParam {Number} address 地区code
     * @apiParam {String} addressDetail 详细地区
     * @apiParam {Number[]} categories 分类ID
     * @apiParam {String[]} licenses 营业执照
     * @apiParam {String[]} photos 公司照片或单位照片
     * @apiParam {String} notes 公司加盟须知或单位认证须知
     * @apiParam {String} content 公司简介或单位简介
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/companies/
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        if (!$user->can('update', $company)) {
            return $this->response->errorForbidden();
        }
        $request->merge(['user_id' => $user->id]);
        $messages = [
            'name.unique' => '公司名已存在！',
        ];
        $validator = Validator::make($request->all(), ['user_id' => 'required|unique:companies,user_id,'.$company->id], $messages);
        if ($validator->fails()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('422 Unprocessable Entity', $validator->errors());
        }
        //return $this->response->array($request->categories);
        $this->companies->update($company, $request);
        return $this->response->item($company, new CompanyUpdateTransformer());
    }

    /**
     * @api {post} /companies/:id/favorites 公司收藏
     * @apiDescription 公司收藏
     * @apiGroup Company
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/companies/1/favorites
     */
    public function favorite(Company $company)
    {
        $favorites = $company->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            return $this->response->errorBadRequest('你已经收藏！');
        }
        $company->favorites()->create(['user_id' => Auth::id()]);
        return $this->response->created();
    }

    /**
     * @api {post} /jobs/:id/favorites 招聘收藏
     * @apiDescription 招聘收藏
     * @apiGroup Company
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api//jobs/1/favorites
     */
    public function jobFavorite(Job $job)
    {
        $favorites = $job->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            return $this->response->errorBadRequest('你已经收藏！');
        }
        $job->favorites()->create(['user_id' => Auth::id()]);
        return $this->response->created();
    }

    /**
     * @api {post} /products/:id/favorites 产品收藏
     * @apiDescription 产品收藏
     * @apiGroup Company
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/products/1/favorites
     */
    public function productFavorite(Product $product)
    {
        $favorites = $product->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            return $this->response->errorBadRequest('你已经收藏！');
        }
        $product->favorites()->create(['user_id' => Auth::id()]);
        return $this->response->created();
    }

    /**
     * @api {get} /companies/search 公司搜索
     * @apiDescription 公司搜索
     * @apiGroup Company
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiParam {String} q 搜索关键字
     * @apiParam {Number{0,1,2,3}} role 企业性质
     * @apiParam {Number} categories 企业分类
     * @apiParam {Number} address 地区码
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 3,
                "name": "测试公司",
                "province": "北京市",
                "city": "北京市",
                "area": "石景山区",
                "addressDetail": "",
                "telephone": "0592-5928529",
                "photos": "http://stone.dev/storage/companies/2016/11/192330UhMQ.png",
                "is_validate": 0,
                "is_excellent": 0
            }
        ],
        "meta": {
            "pagination": {
                "total": 1,
                "count": 1,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
     * @apiSampleRequest /api/companies/search
     */
    public function search(Request $request)
    {
        $query = Company::select();

        if ($request->q) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', "%$request->q%")
                ->orWhere('notes', 'like', "%$request->q%")
                ->orWhere('content', 'like', "%$request->q%");
            });
        }

        if (isset($request->role)) {
            if ($request->role == 0) {
                $query->where(function ($query) {
                    $query->where('role', 1)
                    ->orWhere('role', 2);
                });
            } else {
                $query->where('role', $request->role);
            }
        }

        if ($request->categories) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('category_id', $request->categories);
            });
        }

        if ($request->address) {
            $provinces = Area::where('parent_id', $request->address)->with('childrens')->get();
            if (count($provinces)) {
                foreach ($provinces as $key => $province) {
                    $city = $province->childrens;
                    if (count($city)) {
                        $citys[] = $province->childrens;
                    }
                }
                //搜索省级地址
                if (isset($citys)) {
                    $citys = collect($citys);
                    $citys = $citys->collapse();
                    foreach ($citys as $value) {
                        $area = Area::where('parent_id', $value->code)->get();
                        if (count($area)) {
                            $areas[] = $area;
                        }
                    }
                    if (isset($areas)) {
                        $areas = collect($areas);
                        $areas = $areas->collapse();
                        $query->whereIn('address', $areas);
                    } else {
                        $query->whereIn('address', $citys);
                    }
                } else {
                    //搜索市级地址
                    $query->whereIn('address', $provinces);
                }
            } else {
                //搜索区级地址
                $query->where('address', $request->address);
            }
        }

        $companies = $query->paginate();
        return $this->response->paginator($companies, new CompanyTransformer());
    }
}
