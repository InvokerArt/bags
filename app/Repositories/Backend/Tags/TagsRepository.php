<?php

namespace App\Repositories\Backend\Tags;

use App\Exceptions\GeneralException;
use App\Models\Tag;
use App\Repositories\Backend\Tags\TagRepository;
use DB;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class TagsRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Tag::class;

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
        return $this->query()->orderBy($order_by, $sort)
        ->get();
    }

    public function getPopularTags($limit = 10)
    {
        //ORM获取
        return $this->query()->select('id', 'name')
        ->withCount('news')
        ->limit($limit)
        ->get()
        ->sortByDesc(function ($query) {
            return $query->news->count();
        });
        //原始mysql获取
        // $tags = $this->query()->select ([
        //     'id',
        //     'name',
        //     DB::raw('count(taggables.taggable_id) AS count'),
        //     'created_at'
        // ])
        // ->leftJoin('taggables', 'taggables.taggable_id', '=', 'tags.id')
        // ->groupBy('tags.id')
        // ->limit($limit)
        // ->orderBy('count', 'desc')
        // ->get();
        // return $tags;
    }

    public function getForDataTable()
    {
        $tags = $this->query()->select('*')->withCount('news');
        return $tags;
    }

    public function create($input)
    {
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException('标签已存在！');
        }

        $result = DB::transaction(function () use ($input) {
            $tag = self::MODEL;
            $tag = new $tag;
            $tag->name = $input['name'];

            if (parent::save($tag)) {
                return $tag;
            }

            throw new GeneralException('添加标签失败！');
        });

        return $result;
    }

    public function update(Model $tag, array $input)
    {
        $tag->name = $input['name'];
        if (parent::save($tag)) {
            return true;
        }
        throw new GeneralException('更新失败！');
    }

    public function destroy(Model $tag)
    {
        if ($tag->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
