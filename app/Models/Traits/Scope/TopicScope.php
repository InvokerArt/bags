<?php

namespace App\Models\Traits\Scope;

trait TopicScope
{
    public function scopeWhose($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id)->with('category');
    }

    public function scopeByWhom($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeWithOutBlank($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
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
}
