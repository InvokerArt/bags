<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    //省
    public function province()
    {
        $provinces = Area::select('code', 'name', 'parent_id')->where('parent_id', '!=', 0)->get()->toArray();
        foreach ($provinces as $key => $value) {
            $result[] = '['.$value['code'].', "'.$value['name'].'", '.$value['parent_id'].']';
        }

        return $result;
    }

    //下级地区
    public function cityOrArea($id)
    {
        $childrens = Area::select('code', 'name')->where('parent_id', $id)->get()->toArray();
        return $childrens;
    }
}
