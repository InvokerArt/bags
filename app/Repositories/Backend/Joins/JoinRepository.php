<?php

namespace App\Repositories\Backend\Joins;

use App\Exceptions\GeneralException;
use App\Models\Company;
use App\Models\Join;
use App\Models\User;
use App\Repositories\Backend\Notifications\NotificationInterface;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class JoinRepository implements JoinInterface
{
    private $notification;

    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    public function getForDataTable()
    {
        return Join::select('joins.*', 'users.username', 'companies.name as companyname')
                ->leftJoin('users', 'users.id', '=', 'joins.user_id')
                ->leftJoin('companies', 'companies.id', '=', 'joins.company_id');
    }

    public function create($input)
    {
        $user = User::where('id', $input['user_id'])->first();
        if (!$user) {
            throw new GeneralException("会员不存在！");
        }
        $company = Company::where('id', $input['company_id'])->first();
        if (!$company) {
            throw new GeneralException("公司不存在！");
        }
        if ($company->user_id == $user->id) {
            throw new GeneralException('不能加盟自己的公司！');
        }
        if ($company && $company->role === 3) {
            throw new GeneralException('该公司不属于采购商或加盟商！');
        }
        $isJoin = Join::where('company_id', $company->id)->where('user_id', $user->id)->whereIn('status', [1, 2])->first();
        if ($isJoin) {
            throw new GeneralException('请勿重复申请加盟该公司！');
        }

        $join = new Join;
        $join->user_id = $user->id;
        $join->company_id = $company->id;
        $join->identity_card = $input['identity_card'];
        $join->licenses = $input['licenses'];
        $join->status = $input['status'];

        DB::transaction(function () use ($join, $input, $company) {
            if ($join->save()) {
                if ($input['action']) {
                    $join->user_id = $company->user_id;
                    $join->type =  get_class($join);
                    $join->action = $input['action'];
                    $this->notification->createPersonal($join);
                }
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Join $join, $input)
    {
        $join->identity_card = $input['identity_card'];
        $join->licenses = $input['licenses'];
        $join->status = $input['status'];

        DB::transaction(function () use ($join) {
            if ($join->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $join = $this->findOrThrowException($id);

        if ($join->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $join = $this->findOrThrowException($id);

        if ($join->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $join = $this->findOrThrowException($id);

        if ($join->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $join = Join::find($id);

        if (!is_null($join)) {
            return $join;
        }

        throw new GeneralException('未找到加盟信息');
    }
}
