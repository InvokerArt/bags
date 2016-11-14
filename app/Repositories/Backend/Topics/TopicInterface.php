<?php

namespace App\Repositories\Backend\Topics;

use App\Models\Topics\Topic;

interface TopicInterface
{
    public function getForDataTable();

    /**
     * @param  $input
     * @return mixed
     */
    public function create($input);

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update(Topic $topic, $input);

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);
    
    /**
     * @param  $id
     * @return mixed
     */
    public function restore($id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * 用户是否已经收藏帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userFavorite($topic_id, $user_id);

    /**
     * 是否已经支持帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userTopicVoted($topic_id, $user_id);
}
