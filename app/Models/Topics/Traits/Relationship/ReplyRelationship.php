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
}
