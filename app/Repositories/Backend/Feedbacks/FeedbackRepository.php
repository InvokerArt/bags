<?php

namespace App\Repositories\Backend\Feedbacks;

use App\Exceptions\GeneralException;
use App\Models\Feedbacks\Feedback;
use App\Models\Users\User;
use DB;
use Auth;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class FeedbackRepository implements FeedbackInterface
{

    public function getForDataTable()
    {
        return Feedback::with('user');
    }

    public function create($input)
    {
        $feedback = new Feedback;
        $feedback->user_id = Auth::id();
        $feedback->content = $input['content'];

        DB::transaction(function () use ($feedback) {
            if ($feedback->save()) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        if ($feedback->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
