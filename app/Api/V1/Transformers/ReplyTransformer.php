<?php

namespace App\Api\V1\Transformers;

class ReplyTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['user'];

    public function transformData($model)
    {
        return [
            "id" => $model->id,
            "topic_id" => $model->topic_id,
            "user_id" => $model->user_id,
            "content" => $model->content,
            "vote_count" => $model->vote_count,
            'created_at' => $model->created_at->toDateTimeString(),
            'replyTo_userid' => ($model->replyTo) ? $model->replyTo->user->id : '',
            'replyTo_username' => ($model->replyTo) ? $model->replyTo->user->username : '',
            'is_vote' => isset($model->is_vote) && $model->is_vote ? 1 : 0,
        ];
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer());
    }
}
