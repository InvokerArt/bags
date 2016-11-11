<?php

namespace App\Models\Topics\Traits\Relationship;

trait ReplyRelationship
{
    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    //话题一对一反向
    public function topic()
    {
        return $this->belongsTo('App\Models\Topics\Topic');
    }

    //话题一对一反向
    public function replyTo()
    {
        return $this->belongsTo('App\Models\Topics\Reply', 'parent_id');
    }

    public function votes()
    {
        return $this->morphMany('App\Models\Topics\Vote', 'votable');
    }

    public function scopeWhose($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id)->with('topic');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeWithoutBlocked($query)
    {
        return $query->where('is_blocked', '=', 'no');
    }
}
