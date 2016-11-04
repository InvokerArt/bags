<?php

namespace App\Api\V1\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Helpers;
}
