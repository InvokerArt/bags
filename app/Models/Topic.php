<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Traits\Attribute\TopicAttribute;
use App\Models\Traits\Relationship\TopicRelationship;
use App\Models\Traits\Scope\TopicScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use TopicScope, SoftDeletes, TopicRelationship, TopicAttribute;

    protected $dates = ['deleted_at'];

    /**
     * 白名单
     * @var [type]
     */
    protected $fillable = ['title', 'slug', 'excerpt', 'source', 'content', 'user_id', 'category_id', 'reply_count', 'view_count', 'vote_count', 'last_reply_user_id', 'order', 'is_excellent', 'is_blocked', 'is_tagged', 'created_at', 'updated_at'
    ];

    public static function topicFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('id', $request->get('id'));
        }

        if ($request->has('title')) {
            $query = $query->where('title', 'like', "%{$request->get('title')}%");
        }

        if ($request->has('username')) {
            $query = $query->where('users.username', $request->get('username'));
        }

        if ($request->has('category')) {
            $query = $query->where('categories_topics.id', $request->get('category'));
        }

        if ($request->has('is_excellent')) {
            $query = $query->where('is_excellent', $request->get('is_excellent'));
        }

        if ($request->has('is_blocked')) {
            $query = $query->where('is_blocked', $request->get('is_blocked'));
        }

        return $query;
    }
    
    public function getTopicsWithFilter($filter)
    {
        $filter = $this->getTopicFilter($filter);

        return $this->applyFilter($filter)
                    ->with('user', 'category', 'lastReplyUser')
                    ->paginate();
    }

    public function getCategoryTopicsWithFilter($filter, $category_id)
    {
        return $this->applyFilter($filter == 'default' ? 'category' : $filter)
                    ->where('category_id', '=', $category_id)
                    ->with('user', 'category', 'lastReplyUser')
                    ->paginate();
    }

    public function getTopicFilter($request_filter)
    {
        $filters = ['noreply', 'vote', 'excellent','recent'];
        if (in_array($request_filter, $filters)) {
            return $request_filter;
        }
        return 'default';
    }

    public function applyFilter($filter)
    {
        $query = $this->withoutBlocked();

        switch ($filter) {
            case 'noreply':
                return $query->pinned()->orderBy('reply_count', 'asc')->recent();
                break;
            case 'vote':
                return $query->pinned()->orderBy('vote_count', 'desc')->recent();
                break;
            case 'excellent':
                return $query->excellent()->recent();
                break;
            case 'recent':
                return $query->pinned()->recent();
                break;

            default:
                return $query->pinAndRecentReply();
                break;
        }
    }

    public function correctApiFilter($filter)
    {
        switch ($filter) {
            case 'newest':
                return 'recent';

            case 'excellent':
                return 'excellent-pinned';

            case 'nobody':
                return 'noreply';

            default:
                return $filter;
        }
    }
}
