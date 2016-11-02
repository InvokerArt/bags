<?php

namespace App\Repositories\Backend\Joins;

use App\Exceptions\GeneralException;
use App\Models\Companies\Company;
use App\Models\Joins\Join;
use App\Models\Users\User;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class JoinRepository implements JoinInterface
{
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
        $isJoin = Join::where('company_id', $company->id)->first();
        if ($isJoin) {
            throw new GeneralException('请勿重复加盟该公司！');
        }

        $join = new Join;
        $join->user_id = $user->id;
        $join->company_id = $company->id;
        $join->identity_card = $input['identity_card'];
        $join->licenses = $input['licenses'];
        $join->status = isset($input['status']) ? $input['status'] : 2;

        DB::transaction(function () use ($join) {
            if ($join->save()) {
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
