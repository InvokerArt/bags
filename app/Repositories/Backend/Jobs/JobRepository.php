<?php

namespace App\Repositories\Backend\Jobs;

use App\Exceptions\GeneralException;
use App\Models\Job;
use App\Models\User;
use DB;
use Auth;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class JobRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Job::class;

    public function getForDataTable()
    {
        return $this->query()->select('jobs.*', 'users.username')
                ->leftJoin('users', 'users.id', '=', 'jobs.user_id');
    }

    public function create($input)
    {
        $user = User::where('id', $input['user_id'])->first();

        if (!$user) {
            throw new GeneralException("会员不存在！");
        }

        $job = self::MODEL;
        $job = new $job;
        $job->user_id = $input['user_id'];
        $job->job = $input['job'];
        $job->total = $input['total'];
        $job->education = $input['education'];
        $job->experience = $input['experience'];
        $job->minsalary = $input['minsalary'];
        $job->content = $input['content'];

        DB::transaction(function () use ($job) {
            if (parent::save($job)) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $job, array $input)
    {
        DB::transaction(function () use ($job, $input) {
            if (parent::update($job, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $job)
    {
        if (parent::delete($job)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $job)
    {
        if (is_null($job->deleted_at)) {
            throw new GeneralException('公司不能恢复！');
        }
        if (parent::restore($job)) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete(Model $job)
    {
        if (is_null($job->deleted_at)) {
            throw new GeneralException('要先删除公司！');
        }
        DB::transaction(function () use ($job) {
            if (parent::forceDelete($job)) {
                return true;
            }
            throw new GeneralException('删除失败！');
        });
    }

    public function indexByUser()
    {
        $user = Auth::user();
        return $user->jobs()->orderBy('created_at', 'DESC')->paginate();
    }

    public function createFavorite(Model $job)
    {
        $favorites = $job->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            throw new GeneralException('你已经收藏！');
        }
        $job->favorites()->create(['user_id' => Auth::id()]);
    }
}
