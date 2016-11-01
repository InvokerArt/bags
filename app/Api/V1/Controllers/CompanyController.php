<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\BannerTransformer;
use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\CompanyShowTransformer;
use App\Api\V1\Transformers\CompanyTransformer;
use App\Api\V1\Transformers\JobTransformer;
use App\Api\V1\Transformers\ProductTransformer;
use App\Models\Banners\Image;
use App\Models\Companies\CategoryCompany;
use App\Models\Companies\Company;
use App\Models\Jobs\Job;

class CompanyController extends BaseController
{
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
                "published_from": "2016-11-30 17:49:05",
                "published_to": "2016-12-31 17:49:05"
            },
            {
                "id": 8,
                "title": "我是招商加盟轮播2",
                "image_url": "/storage/banners/a766a4fb33a03664caaad1017937f404.png",
                "order": 8,
                "published_from": "2016-11-30 17:49:26",
                "published_to": "2016-12-31 17:49:26"
            }
        ]
    }
     * @apiSampleRequest /api/companies/banner
     */
    public function banner()
    {
        $images = Image::where('banner_id', 2)->get();
        return $this->response->collection($images, new BannerTransformer());
    }

    /**
     * @api {get} /companies/role/:id 公司列表
     * @apiDescription 公司列表 :id //1为采购商 //2为供应商 //3为机构/单位
     * @apiGroup Company
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "name": "航运城",
                "address": 350203,
                "telephone": "0592-5928529",
                "image": [
                    "/storage/companies/2016/11/192246tXXv.png",
                    "/storage/companies/2016/11/192247z703.png"
                ]
            },
            {
                "id": 2,
                "name": "淘宝公司",
                "address": 460323,
                "telephone": "0592-5928529",
                "image": [
                    "/storage/companies/2016/11/19231089Kl.png",
                    "/storage/companies/2016/11/192311fmt8.png"
                ]
            },
            {
                "id": 3,
                "name": "测试公司",
                "address": 110107,
                "telephone": "0592-5928529",
                "image": [
                    "/storage/companies/2016/11/192330UhMQ.png"
                ]
            }
        ],
        "meta": {
            "pagination": {
                "total": 3,
                "count": 3,
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
        $company = Company::where('role', $id)->paginate();
        return $this->response()->paginator($company, new CompanyTransformer());
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
     * @apiDescription 公司详情 :id 公司ID
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
                "image": [
                    "/storage/companies/2016/11/192246tXXv.png",
                    "/storage/companies/2016/11/192247z703.png"
                ],
                "created_at": "2016-11-01 18:22:53"
            }
        }
     * @apiSampleRequest /api/companies/1
     */
    public function show(Company $company)
    {
        $company->increment('view_count', 1);
        return $this->response->item($company, new CompanyShowTransformer());
    }

    /**
     * @api {get} /companies/:id/jobs 公司招聘
     * @apiDescription 公司招聘 :id 公司ID
     * @apiGroup Company
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *
    {
        "data": [
            {
                "id": 1,
                "content": "<p>招聘职位： &nbsp; 销售代表&nbsp;</p><p>招聘人数： &nbsp; 6人</p><p>学历要求： &nbsp; 不限&nbsp;</p><p>工作年限： &nbsp; 不限&nbsp;</p><p>薪资待遇： &nbsp; 5000-8000元&nbsp;</p><p>&nbsp; &nbsp; 其他 &nbsp;： &nbsp;&nbsp;</p><p>&nbsp;1、五险+无责任底薪+高提成&nbsp;</p><p>&nbsp;2、</p><p><br/></p>"
            }
        ]
    }


    没有招聘内容的时候为
    {
        "data": []
    }
     * @apiSampleRequest /api/companies/1/jobs
     */
    public function job(Company $company)
    {
        $user = $company->user()->first();
        $jobs = $user->jobs()->get();
        return $this->response->collection($jobs, new JobTransformer());
    }

    /**
     * @api {get} /companies/:id/products 公司产品
     * @apiDescription 公司产品 :id 公司ID
     * @apiGroup Company
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *
    没有产品内容的时候为
    {
        "data": []
    }
     * @apiSampleRequest /api/companies/1/products
     */
    public function product(Company $company)
    {
        $user = $company->user()->first();
        $products = $user->products()->get();
        return $this->response->collection($products, new ProductTransformer());
    }
}
