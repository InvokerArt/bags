<?php

namespace App\Repositories\Backend\Topics;

use App\Exceptions\GeneralException;
use App\Models\Topics\Topic;
use App\Models\Topics\TopicCategory;
use DB;
use Auth;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class TopicRepository implements TopicInterface
{
    public function getForDataTable()
    {
        /**
         * withCount--统计关联的结果而不实际的加载它们。
         */
        return Topic::with(['tags', 'categories'])->withCount('comments');
    }

    public function create($input)
    {
        $topic = new Topic;
        $topic->title = $input['title'];
        //$topic->slug = $input['slug'];
        $topic->user_id = Auth::guard('admin')->id();
        $topic->subtitle = $input['subtitle'];
        $topic->content = $input['content'];
        $topic->image = $input['image'];
        $topic->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();

        DB::transaction(function () use ($topic, $input) {
            if ($topic->save()) {
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
                    $topic->attachTags($attachTags);
                }
                $topic->attachCategories($categories_id);

                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Topic $topic, $input)
    {
        $topic->title = $input['title'];
        $topic->subtitle = $input['subtitle'];
        $topic->content = $input['content'];
        $topic->image = $input['image'];
        $topic->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();

        DB::transaction(function () use ($topic, $input) {
            if ($topic->update()) {
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
                    $topic->syncTags($attachTags);
                }
                $topic->syncCategories($categories_id);

                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $topic = Topic::find($id);
        if ($topic->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $topic = Topic::find($id);
        if ($topic->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $topic = Topic::find($id);
        if ($topic->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
