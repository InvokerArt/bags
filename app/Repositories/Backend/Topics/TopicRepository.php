<?php

namespace App\Repositories\Backend\Topics;

use App\Exceptions\GeneralException;
use App\Models\Favorite;
use App\Models\Topic;
use App\Models\TopicCategory;
use App\Models\Vote;
use Auth;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class TopicRepository implements TopicInterface
{
    public function getForDataTable()
    {
        return Topic::select('topics.*', 'categories_topics.name as category', 'users.username as username')
        ->leftJoin('categories_topics', 'categories_topics.id', 'topics.category_id')
        ->leftJoin('users', 'users.id', 'topics.user_id');
    }

    public function create($input)
    {
        $topic = new Topic;
        $topic->title = $input['title'];
        //$topic->slug = $input['slug'];
        $topic->excerpt = $input['excerpt'];
        $topic->content = $input['content'];
        $topic->user_id = $input['user_id'];
        $topic->category_id = $input['category_id'];
        $topic->is_excellent = $input['is_excellent'];
        $topic->is_blocked = $input['is_blocked'];
        $topic->view_count = $input['view_count'];
        $topic->reply_count = $input['reply_count'];
        $topic->vote_count = $input['vote_count'];

        DB::transaction(function () use ($topic) {
            if ($topic->save()) {
                return $topic;
            }

            throw new GeneralException("添加失败");
        });
        return $topic;
    }

    public function update(Topic $topic, $input)
    {
        $data = [
            'title' => $input['title'],
            //'slug' => $input['slug'],
            'excerpt' => $input['excerpt'],
            'content' => $input['content'],
            'user_id' => $input['user_id'],
            'category_id' => $input['category_id'],
            'is_excellent' => $input['is_excellent'],
            'is_blocked' => $input['is_blocked'],
            'view_count' => $input['view_count'],
            'reply_count' => $input['reply_count'],
            'vote_count' => $input['vote_count']
        ];

        $data = array_filter($data);

        DB::transaction(function () use ($topic, $data) {
            if ($topic->update($data)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $topic = $this->findOrThrowException($id);
        if ($topic->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $topic = $this->findOrThrowException($id);
        if ($topic->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $topic = $this->findOrThrowException($id);
        if ($topic->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $demand = Topic::withTrashed()->find($id);

        if (!is_null($demand)) {
            return $demand;
        }

        throw new GeneralException('未找到需求信息');
    }

    public function userFavorite($topic_id, $user_id)
    {
        return Favorite::where([
            'user_id'      => $user_id,
            'favorite_id'   => $topic_id,
            'favorite_type' => 'App\Models\Topic',
        ])->exists();
    }

    /**
     * 是否已经支持帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userTopicVoted($topic_id, $user_id)
    {
        return Vote::query()->where([
            'user_id'      => $user_id,
            'votable_id'   => $topic_id,
            'votable_type' => 'App\Models\Topic',
            'is'           => 'topic_vote',
        ])->exists();
    }
}
