<?php

namespace App\Repositories\Backend\Feedbacks;

use App\Exceptions\GeneralException;
use App\Models\Feedback;
use App\Models\User;
use DB;
use Auth;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class FeedbackRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Feedback::class;

    public function getForDataTable()
    {
        return $this->query()->with('user');
    }

    public function create($input)
    {
        $feedback = self::MODEL;
        $feedback = new $feedback;
        $feedback->user_id = Auth::id();
        $feedback->content = $input['content'];

        DB::transaction(function () use ($feedback) {
            if (parent::save($feedback)) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function destroy(Model $feedback)
    {
        if (parent::delete($feedback)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
