<?php

namespace App\Http\Controllers\Backend\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Companies\CompanyRequest;
use App\Http\Requests\Backend\Companies\CompanyStoreOrUpdateRequest;
use App\Models\Access\User\User;
use App\Models\Backend\Area;
use App\Models\Backend\Companies\CategoryCompany;
use App\Models\Backend\Companies\Company;
use App\Repositories\Backend\Companies\CompanyInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CompanyController extends Controller
{
    protected $company;
    protected $categories;

    public function __construct(CompanyInterface $company, CategoryCompany $categories)
    {
        $this->company = $company;
        $this->categories = $categories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categories->all();
        return view('backend.companies.index', compact('categories'));
    }

    /**
     * 公司列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get(CompanyRequest $request)
    {
        return Datatables::of($this->company->getForDataTable())
            // ->filter(function ($query) use ($request) {
            //     Company::companyFilter($query, $request);
            // })
            ->addColumn('ids', function ($company) {
                return $company->checkbox_button;
            })
            ->editColumn('categories', function ($company) {
                return $company->categories->map(function ($category) {
                    return $category->name;
                })->implode('<br>');
            })
            ->addColumn('actions', function ($company) {
                return $company->action_buttons;
            })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreOrUpdateRequest $request)
    {
        $this->company->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.company.index')->withFlashSuccess('公司添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $categories = $company->categories->pluck('id')->toArray();
        $user = User::where('id', $company->user_id)->first();
        $company->username = $user->username;
        $city = Area::select('*')->where('code', $company->address)->first();
        $province = Area::select('*')->where('code', $city->parent_id)->first();
        $location = json_encode(['province' => $province->parent_id, 'city' => $city->parent_id ,'area' => $company->address]);
        return view('backend.companies.edit', compact(['company', 'categories', 'location']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Company $company, CompanyStoreOrUpdateRequest $request)
    {
        $this->company->update($company, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.company.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
