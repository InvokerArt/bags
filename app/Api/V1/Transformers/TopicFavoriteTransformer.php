<?php

namespace App\Api\V1\Transformers;

use Carbon\Carbon;

class TopicFavoriteTransformer extends BaseTransformer
{
    protected $availableIncludes = ['user', 'last_reply_user', 'replies', 'category'];

    protected $defaultIncludes = ['user','replies'];

    public function transformData($model)
    {
        //Carbon::setLocale('zh');
        return [
            "id" => $model->id,
            'topic_id' => $model->topic_id,
            "category_id" => $model->category_id,
            "title" => $model->title,
            "content" => $model->content,
            "reply_count" => $model->reply_count,
            "view_count" => $model->view_count,
            "vote_count" => $model->vote_count,
            "is_excellent" => $model->is_excellent == 'yes' ? 1 : 0,
            "created_at" => $model->created_at->toDateTimeString(), //Carbon::createFromTimeStamp(strtotime($model->created_at))->diffForHumans() 生成几分钟前 几天前几个月前
            "is_vote" => $model->is_vote,
            'is_favorite' => isset($model->is_favorite) && $model->is_favorite ? 1 : 0,
        ];
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer());
    }

    public function includeLastReplyUser($model)
    {
        return $this->item($model->lastReplyUser ?: $model->user, new UserTransformer());
    }

    public function includeReplies($model)
    {
        return $this->collection($model->replies, new ReplyTransformer());
    }

    public function includeCategory($model)
    {
        return $this->item($model->category, new CategoryTransformer());
    }
}
