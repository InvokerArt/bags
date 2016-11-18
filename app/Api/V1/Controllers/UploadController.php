<?php

namespace App\Api\V1\Controllers;

use App\Repositories\Backend\Users\UserInterface;
use Illuminate\Http\Request;
use Image;
use Storage;

class UploadController extends BaseController
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @apiDefine Upload 上传
     */

    /**
     * @api {post} /upload/avatar 上传头像
     * @apiDescription 上传头像
     * @apiGroup Upload
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
      "data": {
        "avatar": {
          "large": "http://stone.dev/uploads/avatars/20161115071249_180x180.png",
          "medium": "http://stone.dev/uploads/avatars/20161115071249_65x65.png",
          "small": "http://stone.dev/uploads/avatars/20161115071249_30x30.png"
        }
      }
    }
     */
    public function avatar(Request $request)
    {
        try {
            $result['data'] = $this->user->apiAvatar($request);
            return $this->response->array($result);
        } catch (Exception $e) {
            return $this->response->errorBadRequest('上传失败！');
        }
    }

    /**
     * @api {post} /upload/company 认证或需求
     * @apiDescription  认证或需求
     * @apiGroup Upload
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
      "data": {
        "url": "http://stone.dev/storage/companies/2016/11/071424ITZv.png"
      }
    }
     */
    public function company(Request $request)
    {
        try {
            $url = '';
            $content = $request->getContent();
            $filePath = 'companies/'.date('Y').'/'.date('m').'/'.date('His').str_random(4).'.png';
            $result = Storage::put($filePath, $content);
            if ($result) {
                $url['data']['url'] = asset(Storage::url($filePath));
            }
            return $this->response->array($url);
        } catch (Exception $e) {
            return $this->response->errorBadRequest('上传失败！');
        }
    }

    /**
     * @api {post} /upload/product 上传产品
     * @apiDescription 上传产品
     * @apiGroup Upload
     * @apiPermission 无
     * @apiVersion 1.0.0
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
      "data": {
        "url": "http://stone.dev/uploads/products/2016/11/071549GTEr.png"
      }
    }
     */
    public function product(Request $request)
    {
        try {
            $url = '';
            $content = $request->getContent();
            $img = Image::make($content);
            $filePath = 'uploads/products/'.date('Y').'/'.date('m').'/'.date('His').str_random(4).'.png';
            $img->save($filePath);
            $url['data']['url'] = asset($filePath);
            return $this->response->array($url);
        } catch (Exception $e) {
            return $this->response->errorBadRequest('上传失败！');
        }
    }
}