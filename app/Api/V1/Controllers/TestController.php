<?php

namespace App\Api\V1\Controllers;

use Dingo\Api\Routing\Helpers;
use App\Api\ApiHelper;
use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use Helpers;
    
    public function index()
    {
        return $this->response->errorNotFound('配置信息不存在');
    }
}
