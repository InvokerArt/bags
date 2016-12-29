<?php

namespace App\Repositories\Backend\Companies;

use App\Exceptions\GeneralException;
use App\Models\User;
use App\Models\CategoriesCompanies;
use App\Models\Company;
use Auth;
use Carbon;
use DB;
use App\Models\Area;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class CompanyRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Company::class;

    public function getForDataTable()
    {
        return $this->query()->select('*');
    }

    public function create($input)
    {
        $user = User::where('id', $input['user_id'])->first();
        if (!$user) {
            throw new GeneralException("会员不存在！");
        }

        $company = self::MODEL;
        $company = new $company;
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
        $company->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($company, $input) {
            if (parent::save($company)) {
                if (isset($input['categories'])) {
                    $company->attachCategories($input['categories']);
                }
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $company, array $input)
    {
        // $data = [
        //     'name' => $input['name'],
        //     'telephone' => $input['telephone'],
        //     'address' => $input['address'],
        //     'addressDetail' => $input['addressDetail'],
        //     'notes' => $input['notes'],
        //     'content' => $input['content'],
        //     'licenses' => $input['licenses'],
        //     'photos' => $input['photos'],
        //     'role' => $input['role'],
        //     'is_excellent' => $input['is_excellent']
        // ];
        
        // $data = array_filter($data);

        DB::transaction(function () use ($company, $input) {

            if (parent::update($company, $input)) {
                if (isset($input['categories'])) {
                    $company->syncCategories($input['categories']);
                }
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $company)
    {
        if (parent::delete($company)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $company)
    {
        if (is_null($company->deleted_at)) {
            throw new GeneralException('公司不能恢复！');
        }
        if (parent::restore($company)) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete(Model $company)
    {
        if (is_null($company->deleted_at)) {
            throw new GeneralException('要先删除公司！');
        }
        DB::transaction(function () use ($company) {
            if (parent::forceDelete($company)) {
                return true;
            }
            throw new GeneralException('删除失败！');
        });
    }

    public function indexByRole($id)
    {
        if ($id) {
            $companies = $this->query()->where('role', $id)->with(['certifications' => function ($query) {
                $query->validate();
            }])->orderBy('created_at', 'DESC')->paginate();
        } else {
            $companies = $this->query()->where('role', 1)->orWhere('role', 2)->with(['certifications' => function ($query) {
                $query->validate();
            }])->orderBy('created_at', 'DESC')->paginate();
        }
        return $companies;
    }

    public function indexCategoriesByRole($id)
    {
        //激活的分类
        return CategoriesCompanies::where('is_active', 1)->where('role', $id)->get();
    }

    public function createFavorite(Model $company)
    {
        $favorites = $company->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            throw new GeneralException('你已经收藏！');
        }
        $company->favorites()->create(['user_id' => Auth::id()]);
    }

    public function search($input)
    {
        $query = $this->query();

        if ($input->q) {
            $query->where(function ($query) use ($input) {
                $query->where('name', 'like', "%$input->q%")
                ->orWhere('notes', 'like', "%$input->q%")
                ->orWhere('content', 'like', "%$input->q%");
            });
        }

        if (isset($input->role)) {
            if ($input->role == 0) {
                $query->where(function ($query) {
                    $query->where('role', 1)
                    ->orWhere('role', 2);
                });
            } else {
                $query->where('role', $input->role);
            }
        }

        if ($input->categories) {
            $query->whereHas('categories', function ($query) use ($input) {
                $query->where('category_id', $input->categories);
            });
        }

        if ($input->address) {
            $provinces = Area::select('code')->where('parent_id', $input->address)->with('childrens')->get();
            if (count($provinces)) {
                foreach ($provinces as $key => $province) {
                    $city = $province->childrens;
                    if (count($city)) {
                        $citys[] = $province->childrens;
                    }
                }
                //搜索省级地址
                if (isset($citys)) {
                    $citys = collect($citys);
                    $citys = $citys->collapse();
                    foreach ($citys as $value) {
                        $area = Area::select('code')->where('parent_id', $value->code)->get();
                        if (count($area)) {
                            $areas[] = $area;
                        }
                    }
                    if (isset($areas)) {
                        $areas = collect($areas);
                        $areas = $areas->collapse();
                        $query->whereIn('address', $areas);
                    } else {
                        $query->whereIn('address', $citys);
                    }
                } else {
                    //搜索市级地址
                    $query->whereIn('address', $provinces);
                }
            } else {
                //搜索区级地址
                $query->where('address', $input->address);
            }
        }

        $companies = $query->paginate();
        return $companies;
    }
}
