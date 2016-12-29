<?php

namespace App\Repositories\Backend\Joins;

use App\Exceptions\GeneralException;
use App\Models\Company;
use App\Models\Join;
use App\Models\User;
use App\Repositories\Backend\Notifications\NotificationRepository;
use DB;
use Auth;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class JoinRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Join::class;

    protected $notification;
    protected $companies;

    public function __construct(NotificationRepository $notification, Company $companies)
    {
        $this->notification = $notification;
        $this->companies = $companies;
    }

    public function getForDataTable()
    {
        return $this->query()->select('joins.*', 'users.username', 'companies.name as companyname')
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
        $isJoin = $this->query()->where('company_id', $company->id)->where('user_id', $user->id)->whereIn('status', [1, 2])->first();
        if ($isJoin) {
            throw new GeneralException('请勿重复申请加盟该公司！');
        }

        $join = self::MODEL;
        $join = new $join;
        $join->user_id = $user->id;
        $join->company_id = $company->id;
        $join->identity_card = $input['identity_card'];
        $join->licenses = $input['licenses'];
        $join->status = $input['status'];

        DB::transaction(function () use ($join, $input, $company) {
            if (parent::save($join)) {
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

    public function update(Model $join, array $input)
    {
        DB::transaction(function () use ($join, $input) {
            if (parent::update($join, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $join)
    {
        if (parent::delete($join)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function indexUserIn()
    {
        $company = $this->companies->select('id')->where('user_id', Auth::id())->first();
        return $this->query()->where('company_id', $company->id)->with('userCompany')->orderBy('created_at', 'DESC')->paginate();
    }

    public function indexUserOut()
    {
        return $this->query()->where('user_id', Auth::id())->with('company')->orderBy('created_at', 'DESC')->paginate();
    }
}
