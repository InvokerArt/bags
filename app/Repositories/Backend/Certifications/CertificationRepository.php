<?php

namespace App\Repositories\Backend\Certifications;

use App\Exceptions\GeneralException;
use App\Models\Certification;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Backend\Notifications\NotificationInterface;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class CertificationRepository implements CertificationInterface
{
    private $notification;

    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }
    
    public function getForDataTable()
    {
        return Certification::select('certifications.*', 'users.username', 'companies.name as companyname')
                ->leftJoin('users', 'users.id', '=', 'certifications.user_id')
                ->leftJoin('companies', 'companies.id', '=', 'certifications.company_id');
    }

    public function create($input)
    {
        $user = User::where('id', $input['user_id'])->first();
        if (!$user) {
            throw new GeneralException("会员不存在！");
        }
        $company = Company::where('id', $input['company_id'])->first();
        if (!$company) {
            throw new GeneralException("机构不存在！");
        }
        if ($company && $company->role != 3) {
            throw new GeneralException('该公司不属于机构/单位！');
        }
        $isCertification = Certification::where('company_id', $company->id)->where('user_id', $user->id)->whereIn('status', [1, 2])->first();
        if ($isCertification) {
            throw new GeneralException('请勿重复申请认证！');
        }

        $certification = new Certification;
        $certification->user_id = $user->id;
        $certification->company_id = $company->id;
        $certification->identity_card = $input['identity_card'];
        $certification->licenses = $input['licenses'];
        $certification->status = $input['status'];

        DB::transaction(function () use ($certification, $input) {
            if ($certification->save()) {
                if ($input['action']) {
                    $certification->type =  get_class($certification);
                    $certification->action = $input['action'];
                    $this->notification->createPersonal($certification);
                }
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Certification $certification, $input)
    {
        $certification->identity_card = $input['identity_card'];
        $certification->licenses = $input['licenses'];
        $certification->status = $input['status'];

        DB::transaction(function () use ($certification) {
            if ($certification->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $certification = $this->findOrThrowException($id);

        if ($certification->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $certification = $this->findOrThrowException($id);

        if ($certification->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $certification = $this->findOrThrowException($id);

        if ($certification->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $certification = Certification::find($id);

        if (!is_null($certification)) {
            return $certification;
        }

        throw new GeneralException('未找到认证信息');
    }
}
