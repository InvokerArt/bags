<?php

namespace App\Repositories\Backend\Jobs;

use App\Exceptions\GeneralException;
use App\Models\Companies\Company;
use App\Models\Jobs\Job;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class JobRepository implements JobInterface
{
    public function getForDataTable()
    {
        return Job::select('jobs.*', 'companies.name as companyName')
                ->leftJoin('companies', 'companies.id', '=', 'jobs.company_id');
    }

    public function create($input)
    {
        $company = Company::where('name', $input['name'])->first();

        if (!$company) {
            throw new GeneralException("公司名不存在！");
        }

        $job = new Job;
        $job->company_id = $company->id;
        $job->content = $input['content'];

        DB::transaction(function () use ($job) {
            if ($job->save()) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Job $job, $input)
    {
        $job->content = $input['content'];

        DB::transaction(function () use ($job) {
            if ($job->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $job = $this->findOrThrowException($id);

        if ($job->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $job = $this->findOrThrowException($id);

        if ($job->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $job = $this->findOrThrowException($id);

        if ($job->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $job = Job::withTrashed($id);

        if (!is_null($job)) {
            return $job;
        }

        throw new GeneralException('未找到招聘信息');
    }
}
