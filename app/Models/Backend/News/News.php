<?php

namespace App\Models\Backend\News;

use App\Models\Access\User\User;
use App\Models\Backend\News\Traits\Attribute\NewsAttribute;
use App\Models\Backend\News\Traits\Relationship\NewsRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Backend\News\News
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $slug 固定链接地址
 * @property string $title 标题
 * @property string $subtitle 副标题
 * @property string $content 内容
 * @property string $image 标题图片
 * @property integer $hits 浏览数
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Backend\Comments\Comment[] $comments 评论数
 * @property boolean $status 状态//0回收站//1已发布//2未来发布
 * @property \Carbon\Carbon $published_at 发布于
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Baum\Extensions\Eloquent\Collection|\App\Models\Backend\News\CategoriesNews[] $categories
 * @property-read \App\Models\Access\User\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Backend\Tags\Tag[] $tags
 * @property-read mixed $checkbox_button
 * @property-read mixed $action_buttons
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereSubtitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereHits($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\News\News whereDeletedAt($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    use NewsRelationship, NewsAttribute;
    /**
     * 默认数据库
     * @var string
     */
    protected $table = 'news';

    /**
     * 发布日期属性
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * 参数黑名单
     * @var array
     */
    protected $guard = [
        'user_id',
    ];

    static function newsFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('id', '=', $request->get('id'));
        }

        if ($request->has('title')) {
            $query = $query->where('title', 'like', "%{$request->get('title')}%");
        }

        if ($request->has('author')) {
            $user = User::where('name', $request->get('author'))->first();
            $user_id = $user ? $user->id : '';
            $query = $query->where('user_id', $user_id);
        }

        /**
         * 使用 whereHas 和 orWhereHas 方法来在 has 查询中插入 where 子句。这些方法允许你为关联进行自定义的约束查询。
         */
        if ($request->has('categories')) {
            $query = $query->whereHas('categories', function ($query) use ($request) {
                $query->where('category_new.category_id', $request->get('categories'));
            });
        }

        if ($request->has('tags')) {
            $query = $query->whereHas('tags', function ($query) use ($request) {
                $query->where('tags.name', $request->get('tags'));
            });
        }

        if ($request->has('published_from') && !$request->has('published_to')) {
            $query = $query->where('published_at', '>=', $request->get('published_from'));
        }

        if (!$request->has('published_from') && $request->has('published_to')) {
            $query = $query->where('published_at', '<=', $request->get('published_to'));
        }

        if ($request->has('published_from') && $request->has('published_to')) {
            $query = $query->whereBetween('published_at', [$request->get('published_from'),$request->get('published_to')]);
        }

        return $query;
    }
}
