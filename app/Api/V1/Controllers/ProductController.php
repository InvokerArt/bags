<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\ProductStoreOrUpdateRequest;
use App\Api\V1\Transformers\ProductShowTransformer;
use App\Api\V1\Transformers\ProductTransformer;
use App\Models\Product;
use App\Repositories\Backend\Products\ProductInterface;
use Auth;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    protected $products;

    public function __construct(ProductInterface $products)
    {
        $this->products = $products;
    }

    /**
     * @apiDefine Product 产品
     */

    /**
     * @api {get} /products 产品列表
     * @apiDescription 产品列表
     * @apiGroup Product
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
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
            },
            {
                "id": 2,
                "title": "我有袋子100箱",
                "price": 100,
                "unit": 5,
                "content": "<p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">加工定制 是</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">用途 通用包装</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">底面侧面 无底无侧</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">供货类型 可定制</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">规格 400*300（mm*mm）</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">加印LOGO 可以</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">款式 手提袋</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">颜色 米白</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">印刷工艺 丝印</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">自重 285（g）</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">品牌 Martina</p><p style=\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\">是否有现货 有</p><p><br/></p>",
                "images": [
                    "/uploads/products/2016/11/165204E76X.png"
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
     * @apiSampleRequest /api/products
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate();
        return $this->response()->paginator($products, new ProductTransformer());
    }

    /**
     * @api {post} /products 发布产品
     * @apiDescription 发布产品 unit代表的单位见顶部(接口说明)
     * @apiGroup Product
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String} title 标题
     * @apiParam {Int} price 价格
     * @apiParam {Number=1,2,3,4,5} unit 单位
     * @apiParam {String[]} images[] 图片
     * @apiParam {String} content 内容
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     * @apiSampleRequest /api/products
     */
    public function store(ProductStoreOrUpdateRequest $request)
    {
        $request->merge(['user_id' => Auth::id()]);
        $request->images = relative_url($request->images);
        $this->products->create($request);
        return $this->response->created();
    }

    /**
     * @api {get} /products/:id 产品详情
     * @apiDescription 产品详情 :id为产品ID
     * @apiGroup Product
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "id": 1,
            "title": "产品标题",
            "province": "海南省",
            "city": "三沙市",
            "area": "中沙群岛的岛礁及其海域",
            "addressDetail": "",
            "telephone": "0592-5928529",
            "price": 1.2,
            "unit": 1,
            "content": "<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>",
            "images": [
                "http://stone.dev/uploads/products/2016/11/092739rqKq.png"
            ],
            "user": {
                "data": {
                    "id": 3,
                    "username": "来我家",
                    "name": "新英雄",
                    "mobile": "13111111112",
                    "email": "ghsjjshhd",
                    "avatar": {
                        "_default": "http://192.168.1.41:8000/uploads/avatars/20161117100823_30x30.png",
                        "small": "http://192.168.1.41:8000/uploads/avatars/20161117100823_30x30_30x30.png",
                        "medium": "http://192.168.1.41:8000/uploads/avatars/20161117100823_30x30_65x65.png",
                        "large": "http://192.168.1.41:8000/uploads/avatars/20161117100823_30x30_180x180.png"
                    },
                    "created_at": "2016-11-02 19:01:58"
                }
            }
        }
    }
     * @apiSampleRequest /api/products/1
     */
    public function show(Product $product)
    {
        $company = $product->company()->first();
        $product->address = $company->address;
        $product->addressDetail = $company->addressDetail;
        $product->telephone = $company->telephone;
        return $this->response->item($product, new ProductShowTransformer());
    }

    /**
     * @api {PATCH} /products/:id 更新产品
     * @apiDescription 更新产品 :id为产品ID
     * @apiGroup Product
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {String} title 标题
     * @apiParam {Number} price 价格
     * @apiParam {Number=1,2,3,4,5} unit 单位
     * @apiParam {String[]} images[] 图片
     * @apiParam {String} content 内容
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": {
            "id": 1,
            "title": "产品标题",
            "address": "福建厦门思明",
            "telephone": "0592-5928529",
            "price": 1.2,
            "unit": 1,
            "content": "<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>",
            "images": [
                "/uploads/products/2016/11/092739rqKq.png"
            ]
        }
    }
     * @apiSampleRequest /api/products/1
     */
    public function update(Product $product, ProductStoreOrUpdateRequest $request)
    {
        $user = Auth::user();

        if (!$user->can('update', $product)) {
            return $this->response->errorForbidden();
        }

        $request->images = relative_url($request->images);
        $this->products->update($product, $request);
        $product = $product->insert_company;
        return $this->response->item($product, new ProductShowTransformer());
    }

    /**
     * @api {delete} /products/:id 删除产品
     * @apiDescription 删除产品 :id 需要删除产品的ID
     * @apiGroup Product
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No Content
     */
    public function destroy(Product $product)
    {
        $user = Auth::user();

        if (!$user->can('delete', $product)) {
            return $this->response->errorForbidden();
        }

        $product->delete();
        return $this->response->noContent();
    }
    /**
     * @api {get} /products/search 产品搜索
     * @apiDescription 产品搜索
     * @apiGroup Product
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiParam {String} q 搜索关键字
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 1,
                "title": "产品标题",
                "price": 1.2,
                "unit": 1,
                "content": "<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>",
                "images": "http://stone.dev/uploads/products/2016/11/092739rqKq.png"
            },
            {
                "id": 3,
                "title": "我要更新一个产品4",
                "price": 1000,
                "unit": 1,
                "content": "内容就是产品够好你买不买",
                "images": "http://stone.dev/uploads/products/2016/11/165204E76X.png"
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
     * @apiSampleRequest /api/products/search
     */
    public function search(Request $request)
    {
        $news = Product::where('title', 'like', "%$request->q%")->orWhere('content', 'like', "%$request->q%")->paginate();
        return $this->response->paginator($news, new ProductTransformer());
    }
}
