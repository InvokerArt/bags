<?php

namespace App\Repositories\Backend\Companies;

use App\Exceptions\GeneralException;
use App\Models\Access\User\User;
use App\Models\Companies\CategoriesCompanies;
use App\Models\Companies\Company;
use Auth;
use Carbon;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class CompanyRepository implements CompanyInterface
{



    public function getForDataTable()
    {
        /**
         * withCount--统计关联的结果而不实际的加载它们。
         */
        return Company::select('*');
    }

    public function create($input)
    {
        $user = User::where('username', $input['username'])->first();
        if (!$user) {
            throw new GeneralException("会员用户名不存在！");
        }
        $user_id = Company::select('user_id')->where('user_id', $user->id)->first();
        if ($user_id) {
            throw new GeneralException("会员已经有拥有公司，请勿重复添加！");
        }

        $company = new Company;
        $company->user_id = $user->id;
        $company->name = $input['name'];
        $company->telephone = $input['telephone'];
        $company->address = $input['address'];
        $company->notes = $input['notes'];
        $company->content = $input['content'];
        $company->licenses = $input['licenses'];
        $company->photos = $input['photos'];
        $company->role = $input['role'];

        DB::transaction(function () use ($company, $input) {

            if ($company->save()) {
                $categories = explode(',', $input['categories']);
                $company->attachCategories($categories);
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Company $company, $input)
    {
        $company->name = $input['name'];
        $company->telephone = $input['telephone'];
        $company->address = $input['address'];
        $company->notes = $input['notes'];
        $company->content = $input['content'];
        $company->licenses = $input['licenses'];
        $company->photos = $input['photos'];
        $company->role = $input['role'];

        DB::transaction(function () use ($company, $input) {

            if ($company->update()) {
                $categories = explode(',', $input['categories']);
                $company->syncCategories($categories);
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
    }

    public function restore($id)
    {
    }

    public function delete($id)
    {
        $company = Company::find($id);
        if ($company->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
