<?php

namespace App\Repositories\Backend\Tags;

use App\Exceptions\GeneralException;
use App\Models\Backend\Tags\Tag;
use App\Repositories\Backend\Tags\TagInterface;
use DB;

class TagsRepository implements TagsInterface
{
    /**
     * [获取所有标签]
     * @Ben
     * @DateTime 2016-08-18T11:21:55+0800
     * @param    string                   $order_by [排序]
     * @param    string                   $sort     [升序或降序]
     * @return   [type]                             [数据]
     */
    public function getAllTags($order_by = 'id', $sort = 'asc')
    {
        return Tag::orderBy($order_by, $sort)
        ->get();
    }

    public function getPopularTags($limit = 10)
    {
        // $tags = Tag::whereHas('news', function ($query) {
        //     $query->select(DB::raw('count(taggables.taggable_id) AS count'))->orderBy('count', 'desc');
        // })
        // ->get();
        // return $tags;
        $tags = Tag::select ([
            'id',
            'name',
            DB::raw('count(taggables.taggable_id) AS count'),
            'created_at'
        ])
        ->leftJoin('taggables', 'taggables.taggable_id', '=', 'tags.id')
        ->groupBy('tags.id')
        ->limit($limit)
        ->orderBy('count', 'desc')
        ->get();
        return $tags;
    }

    public function getForDataTable()
    {
        $tags = Tag::select ([
            'id',
            'name',
            DB::raw('count(taggables.taggable_id) AS count'),
            'created_at'
        ])
        ->leftJoin('taggables', 'taggables.taggable_id', '=', 'tags.id')
        ->groupBy('tags.id');
        return $tags;
    }

    public function create($input)
    {
        if (Tag::where('name', $input['name'])->first()) {
            throw new GeneralException('标签已存在！');
        }

        $result = DB::transaction(function () use ($input) {
            $tag = new Tag;
            $tag->name = $input['name'];

            if ($tag->save()) {
                return $tag;
            }

            throw new GeneralException('添加标签失败！');
        });

        return $result;
    }

    public function update($input, $id)
    {
        $tag = Tag::find($id);
        $tag->name = $input['name'];
        if ($tag->save()) {
            return true;
        }
        throw new GeneralException('更新失败！');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
