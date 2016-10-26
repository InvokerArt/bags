<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plupload;
use Storage;

class UploadController extends Controller
{
    public function index()
    {
        return Plupload::receive('file', function ($file) {
            $file->move(storage_path() . '/test/', $file->getClientOriginalName());
            return 'OK';
        });
    }

    public function company()
    {
        return Plupload::receive('file', function ($file) {
            $filePath = 'companies/'.date('Y').'/'.date('m').'/'.date('His').str_random(4).'.'.$file->guessExtension();
            Storage::put($filePath, file_get_contents($file->getPathname()));
            $url = Storage::url($filePath);

            return ['message' => 'OK', 'url' => $url];
        });
    }

    public function companyDelete(Request $request)
    {
        $url = $request->url;
        Storage::delete(str_replace('/storage/', '', $url));
    }

    public function product()
    {
        return Plupload::receive('file', function ($file) {
            $filePath = 'uploads/products/'.date('Y').'/'.date('m').'/';
            $fileName = date('His').str_random(4).'.'.$file->guessExtension();
            $file->move($filePath, $fileName);
            $url = '/'.$filePath.$fileName;

            return ['message' => 'OK', 'url' => $url];
        });
    }

    public function productDelete(Request $request)
    {
        $url = $request->url;
        unlink(substr($url, 1));
    }
}
