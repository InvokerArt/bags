<?php

namespace App\Repositories\Backend\Topics;

use App\Exceptions\GeneralException;
use App\Models\Favorite;
use App\Models\Topic;
use App\Models\TopicCategory;
use App\Models\Vote;
use Auth;
use DB;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class TopicRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Topic::class;

    public function getForDataTable()
    {
        return $this->query()->select('topics.*', 'categories_topics.name as category', 'users.username as username')
        ->leftJoin('categories_topics', 'categories_topics.id', 'topics.category_id')
        ->leftJoin('users', 'users.id', 'topics.user_id');
    }

    public function create($input)
    {
        $topic = self::MODEL;
        $topic = new $topic;
        $topic->title = $input['title'];
        $topic->slug = $input['slug'];
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
            if (parent::save($topic)) {
                return $topic;
            }

            throw new GeneralException("添加失败");
        });
        return $topic;
    }

    public function update(Model $topic, array $input)
    {
        // $data = [
        //     'title' => $input['title'],
        //     //'slug' => $input['slug'],
        //     'excerpt' => $input['excerpt'],
        //     'content' => $input['content'],
        //     'user_id' => $input['user_id'],
        //     'category_id' => $input['category_id'],
        //     'is_excellent' => $input['is_excellent'],
        //     'is_blocked' => $input['is_blocked'],
        //     'view_count' => $input['view_count'],
        //     'reply_count' => $input['reply_count'],
        //     'vote_count' => $input['vote_count']
        // ];

        // $data = array_filter($data);

        DB::transaction(function () use ($topic, $input) {
            if (parent::update($topic, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $topic)
    {
        if (parent::delete($topic)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $topic)
    {
        if (is_null($topic->deleted_at)) {
            throw new GeneralException('话题不能恢复！');
        }
        if (parent::restore($topic)) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete(Model $topic)
    {
        if (is_null($topic->deleted_at)) {
            throw new GeneralException('要先删除话题！');
        }
        DB::transaction(function () use ($topic) {
            if (parent::forceDelete($topic)) {
                return true;
            }
            throw new GeneralException('删除失败！');
        });
    }

    /**
     * 是否已经支持帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userIsVoted($topic_id, $user_id)
    {
        return Vote::query()->where([
            'user_id'      => $user_id,
            'votable_id'   => $topic_id,
            'votable_type' => 'App\Models\Topic',
            'is'           => 'topic_vote',
        ])->exists();
    }

    public function indexByUser()
    {
        return $this->query()->whose(Auth::id())->orderBy('is_excellent', 'DESC')->recent()->paginate();
    }

    public function indexByUserId($user_id)
    {
        $user  = User::findOrFail($user_id);
        return $this->query()->whose($user_id)->recent()->paginate();
    }

    public function indexByUserVotes()
    {
        $user  = User::findOrFail($user_id);
        return $user->votedTopics()->orderBy('pivot_created_at', 'desc')->paginate();
    }

    public function createFavorite(Model $topic)
    {
        $favorites = $topic->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            throw new GeneralException('你已经收藏！');
        }
        $topic->favorites()->create(['user_id' => Auth::id()]);
    }

    public function indexTopicsReply(Model $topic)
    {
        return $topic->replies()->withoutBlocked()->with(['user', 'replyTo' => function ($query) {
            $query->with('user');
        }])->get();
    }

    public function search($input)
    {
        $query = $this->query();

        if ($input->q) {
            $query->where(function ($query) use ($input) {
                $query->where('title', 'like', "%$input->q%")
                ->orWhere('content', 'like', "%$input->q%");
            });
        }

        if ($input->categories) {
            $query->where('category_id', $input->categories);
        }

        return $query->paginate();
    }
}
