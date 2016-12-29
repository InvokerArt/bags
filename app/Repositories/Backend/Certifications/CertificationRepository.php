<?php

namespace App\Repositories\Backend\Certifications;

use App\Exceptions\GeneralException;
use App\Models\Certification;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Backend\Notifications\NotificationRepository;
use DB;
use Auth;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class CertificationRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Certification::class;

    protected $notification;
    protected $companies;

    public function __construct(NotificationRepository $notification, Company $companies)
    {
        $this->notification = $notification;
        $this->companies = $companies;
    }
    
    public function getForDataTable()
    {
        return $this->query()->select('certifications.*', 'users.username', 'companies.name as companyname')
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
        $isCertification = $this->query()->where('company_id', $company->id)->where('user_id', $user->id)->whereIn('status', [1, 2])->first();
        if ($isCertification) {
            throw new GeneralException('请勿重复申请认证！');
        }

        $certification = self::MODEL;
        $certification = new $certification;
        $certification->user_id = $user->id;
        $certification->company_id = $company->id;
        $certification->identity_card = $input['identity_card'];
        $certification->licenses = $input['licenses'];
        $certification->status = $input['status'];

        DB::transaction(function () use ($certification, $input, $company) {
            if (parent::save($certification)) {
                if ($input['action']) {
                    $certification->user_id = $company->user_id;
                    $certification->type =  get_class($certification);
                    $certification->action = $input['action'];
                    $this->notification->createPersonal($certification);
                }
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $certification, array $input)
    {
        DB::transaction(function () use ($certification, $input) {
            if (parent::update($certification, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $certification)
    {
        if (parent::delete($certification)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function indexUserIn()
    {
        $company = $this->companies->select('id')->where('user_id', Auth::id())->first();
        $certifications = $this->query()->where('company_id', $company->id)->with('userCompany')->orderBy('created_at', 'DESC')->paginate();
        return $certifications;
    }

    public function indexUserOut()
    {
        $certifications = $this->query()->where('user_id', Auth::id())->with('company')->orderBy('created_at', 'DESC')->paginate();
        return $certifications;
    }
}
