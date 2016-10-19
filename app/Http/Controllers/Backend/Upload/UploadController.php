<?php

namespace App\Http\Controllers\Backend\Uploads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plupload;

class UploadController extends Controller
{
    public function index()
    {
        return Plupload::receive('file', function ($file) {
            $file->move(storage_path() . '/test/', $file->getClientOriginalName());
            return 'OK';
        });
    }
}
