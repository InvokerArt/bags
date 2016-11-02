<?php

namespace App\Repositories\Backend\News;

use App\Exceptions\GeneralException;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\Tags\Tag;
use App\Repositories\Backend\Tags\TagsInterface;
use Auth;
use Carbon\Carbon;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class NewsRepository implements NewsInterface
{
    protected $tags;


    public function __construct(TagsInterface $tags)
    {
        $this->tags = $tags;
    }

    public function getForDataTable()
    {
        /**
         * withCount--统计关联的结果而不实际的加载它们。
         */
        return News::with(['tags', 'categories'])->withCount('comments');
    }

    public function create($input)
    {
        $news = new News;
        $news->title = $input['title'];
        //$news->slug = $input['slug'];
        $news->user_id = Auth::guard('admin')->id();
        $news->subtitle = $input['subtitle'];
        $news->content = $input['content'];
        $news->image = $input['image'];
        $news->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();

        DB::transaction(function () use ($news, $input) {
            if ($news->save()) {
                $tag = $input['tag'] ? $input['tag'] : [];
                $categories_id = explode(',', $input['categories_id']);
                $attachTags = [];
                if ($tag) {
                    $tags = explode(',', $tag);
                    foreach ($tags as $tag) {
                        $hasTag = Tag::where('name', $tag)->first();
                        if ($hasTag) {
                            array_push($attachTags, $hasTag->id);
                        } else {
                            $newTag['name'] = $tag;
                            //新标签
                            $tag = $this->tags->create($newTag);
                            array_push($attachTags, $tag->id);
                        }
                    }
                    //更新标签记录
                    $news->attachTags($attachTags);
                }
                $news->attachCategories($categories_id);

                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(News $news, $input)
    {
        $news->title = $input['title'];
        $news->subtitle = $input['subtitle'];
        $news->content = $input['content'];
        $news->image = $input['image'];
        $news->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();

        DB::transaction(function () use ($news, $input) {
            if ($news->update()) {
                $tag = $input['tag'] ? $input['tag'] : [];
                $categories_id = explode(',', $input['categories_id']);
                $attachTags = [];
                if ($tag) {
                    $tags = explode(',', $tag);
                    foreach ($tags as $tag) {
                        $hasTag = Tag::where('name', $tag)->first();
                        if ($hasTag) {
                            array_push($attachTags, $hasTag->id);
                        } else {
                            $newTag['name'] = $tag;
                            //新标签
                            $tag = $this->tags->create($newTag);
                            array_push($attachTags, $tag->id);
                        }
                    }
                    //更新标签记录
                    $news->syncTags($attachTags);
                }
                $news->syncCategories($categories_id);

                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $news = $this->findOrThrowException($id);
        if ($news->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $news = $this->findOrThrowException($id);
        if ($news->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $news = $this->findOrThrowException($id);
        if ($news->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $news = News::withTrashed()->find($id);

        if (!is_null($news)) {
            return $news;
        }

        throw new GeneralException('未找到需求信息');
    }
}
