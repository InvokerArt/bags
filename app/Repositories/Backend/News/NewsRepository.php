<?php

namespace App\Repositories\Backend\News;

use App\Exceptions\GeneralException;
use App\Models\Backend\News\News;
use App\Models\Backend\News\NewsCategory;
use App\Models\Backend\Tags\Tag;
use App\Repositories\Backend\Tags\TagsInterface;
use Carbon;
use DB;
use Auth;

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
        return News::all();
    }

    public function create($input)
    {
        DB::transaction(function () use ($input) {
            $news = new News;
            $news->user_id = Auth::guard('admin')->id();
            $news->title = $input['title'];
            $news->slug = env('APP_URL').'news/'.$input['slug'];
            $news->subtitle = $input['subtitle'];
            $news->content = $input['content'];
            $news->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();
            $news->image = $input['image'];
            if ($news->save()) {
                //标签入库
                $tags = $input['tags'] ? $input['tags'] : [];
                $categories_id = $input['categories_id'];
                if ($input['newtag']) {
                    $newTags = explode(',', $input['newtag']);
                    if (count($newTags)>1) {
                        foreach ($newTags as $newTag) {
                            if (!Tag::where('name', $newTag)->first()) {
                                $tagName['name'] = $newTag;
                                $tag = $this->tags->create($tagName);
                                array_push($tags, $tag->id);
                            }
                        }
                    } else {
                        if (!Tag::where('name', $input['newtag'])->first()) {
                            $tagName['name'] = $input['newtag'];
                            $tag = $this->tags->create($tagName);
                            array_push($tags, $tag->id);
                        }
                    }
                }
                foreach ($tags as $tag) {
                    $news->tags()->attach($tag);
                }
                foreach ($categories_id as $category_id) {
                    $news->categories()->attach($category_id);
                }
                return true;
            }
        });
    }

    public function update($id, $input)
    {
    }

    public function destroy($id)
    {
    }

    public function restore($id)
    {
    }

    public function delete($id)
    {
    }
}
