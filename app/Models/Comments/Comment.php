<?php

namespace App\Models\Comments;

use App\Models\Comments\Traits\Attribute\CommentAttribute;
use App\Models\Comments\Traits\Relationship\CommentRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, CommentAttribute, CommentRelationship;

    public static function commentFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('comments.id', $request->get('id'));
        }

        if ($request->has('username')) {
            $query->whereHas('user', function ($query) use ($request) {
                $query = $query->where('username', 'like', "%{$request->get('username')}%");
            });
        }

        if ($request->has('content')) {
            $query = $query->where('comments.content', 'like', "%{$request->get('content')}%");
        }

        if ($request->has('title')) {
            $query = $query->select('comments.*', 'news.title')->leftJoin('news', 'news.id', 'comments.commentable_id')->where('news.title', 'like', "%{$request->get('title')}%")->orderBy('comments.id');
        }

        return $query;
    }
}
