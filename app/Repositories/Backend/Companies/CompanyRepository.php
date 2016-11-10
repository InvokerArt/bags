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
        $company->is_extension = $input['is_extension'];

        DB::transaction(function () use ($company, $input) {
            if ($company->save()) {
                if (isset($input['categories'])) {
                    $company->attachCategories($input['categories']);
                }
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Company $company, $input)
    {
        $data = [
            'name' => $input['name'],
            'telephone' => $input['telephone'],
            'address' => $input['address'],
            'addressDetail' => $input['addressDetail'],
            'notes' => $input['notes'],
            'content' => $input['content'],
            'licenses' => $input['licenses'],
            'photos' => $input['photos'],
            'role' => $input['role'],
            'is_extension' => $input['is_extension']
        ];
        $data = array_filter($data, 'strlen');
        DB::transaction(function () use ($company, $data, $input) {

            if ($company->update($data)) {
                if (isset($input['categories'])) {
                    $company->attachCategories($input['categories']);
                }
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
