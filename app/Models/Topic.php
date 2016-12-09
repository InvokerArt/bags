<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Traits\Attribute\TopicAttribute;
use App\Models\Traits\Relationship\TopicRelationship;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes, TopicRelationship, TopicAttribute;

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

    public function scopeWhose($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id)->with('category');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeRandom($query)
    {
        return $query->orderByRaw("RAND()");
    }

    public function scopePinAndRecentReply($query)
    {
        return $query->fresh()
                     ->pinned()
                     ->orderBy('updated_at', 'desc');
    }

    public function scopePinned($query)
    {
        return $query->orderBy('order', 'desc');
    }

    public function scopeFresh($query)
    {
        return $query->whereRaw("(`created_at` > '".Carbon::today()->subMonths(3)->toDateString()."' or (`order` > 0) )");
    }

    public function scopeRecentReply($query)
    {
        return $query->pinned()
                     ->orderBy('updated_at', 'desc');
    }

    public function scopeExcellent($query)
    {
        return $query->where('is_excellent', '=', 'yes');
    }

    public function scopeWithoutBlocked($query)
    {
        return $query->where('is_blocked', '=', 'no');
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
