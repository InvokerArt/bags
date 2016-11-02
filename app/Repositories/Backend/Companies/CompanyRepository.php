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
        $user = User::where('id', $input['user_id'])->first();
        if (!$user) {
            throw new GeneralException("会员不存在！");
        }

        $company = new Company;
        $company->user_id = $input['user_id'];
        $company->name = $input['name'];
        $company->telephone = $input['telephone'];
        $company->address = $input['address'];
        $company->addressDetail = $input['addressDetail'];
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
        $company->addressDetail = $input['addressDetail'];
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
