<?php

namespace App\Api\V1\Controllers;

use App\Api\ApiHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\News\News;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use Helpers;
    
    public function index()
    {
        $news = News::paginate()->toArray();
        return response(formatArray($news));
    }
}
