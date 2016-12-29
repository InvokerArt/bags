<?php

namespace App\Repositories\Backend\News;

use App\Exceptions\GeneralException;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Tag;
use App\Repositories\Backend\Tags\TagsRepository;
use Auth;
use Carbon\Carbon;
use DB;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class NewsRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = News::class;

    protected $tags;


    public function __construct(TagsRepository $tags)
    {
        $this->tags = $tags;
    }

    public function getForDataTable()
    {
        /**
         * withCount--统计关联的结果而不实际的加载它们。
         */
        return $this->query()->with(['tags', 'categories'])->withCount('comments');
    }

    public function indexByCategories($input)
    {
        $query = $this->query()->select();
        if ($input->categories) {
            $query->whereHas('categories', function ($query) use ($input) {
                $query->where('id', $input->categories);
            });
        }
        
        return $query->orderBy('created_at', 'DESC')->paginate();
    }

    public function search($input)
    {
        return $this->query()->where('title', 'like', "%$input->q%")->orWhere('subtitle', 'like', "%$input->q%")->orWhere('content', 'like', "%$input->q%")->paginate();
    }

    public function create($input)
    {
        $news = self::MODEL;
        $news = new $news;
        $news->title = $input['title'];
        //$news->slug = $input['slug'];
        $news->user_id = Auth::guard('admin')->id();
        $news->subtitle = $input['subtitle'];
        $news->content = $input['content'];
        $news->image = $input['image'];
        $news->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();
        $news->is_excellent = $input['is_excellent'];


        DB::transaction(function () use ($news, $input) {
            if (parent::save($news)) {
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

    public function update(Model $news, array $input)
    {
        $news->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();

        DB::transaction(function () use ($news, $input) {
            if (parent::update($news, $input)) {
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

    public function destroy(Model $news)
    {
        if (parent::delete($news)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $news)
    {
        if (is_null($news->deleted_at)) {
            throw new GeneralException('新闻不能恢复！');
        }

        if (parent::restore($news)) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete(Model $news)
    {
        if (is_null($news->deleted_at)) {
            throw new GeneralException('要先删除新闻！');
        }
        DB::transaction(function () use ($news) {
            if (parent::forceDelete($news)) {
                return true;
            }
            throw new GeneralException('删除失败！');
        });
    }

    public function createFavorite(Model $news)
    {
        $favorites = $news->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            throw new GeneralException('你已经收藏！');
        }
        $news->favorites()->create(['user_id' => Auth::id()]);
    }
}
