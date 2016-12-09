<?php

namespace App\Http\Controllers\Backend\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Companies\CompanyStoreRequest;
use App\Http\Requests\Backend\Companies\CompanyUpdateRequest;
use App\Models\Admin;
use App\Models\Area;
use App\Models\CategoryCompany;
use App\Models\Company;
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
    public function get(Request $request)
    {
        return Datatables::of($this->company->getForDataTable())
            ->filter(function ($query) use ($request) {
                Company::companyFilter($query, $request);
            })
            ->addColumn('ids', function ($company) {
                return $company->checkbox_button;
            })
            ->editColumn('role', function ($company) {
                return $company->role_button;
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
    public function store(CompanyStoreRequest $request)
    {
        $this->company->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.companies.index')->withFlashSuccess('公司添加成功');
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
        $city = Area::select('code', 'parent_id')->where('code', $company->address)->first();
        $province = Area::select('parent_id')->where('code', $city->parent_id)->first();
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
    public function update(Company $company, CompanyUpdateRequest $request)
    {
        $this->company->update($company, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.companies.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->company->destroy($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.companies.index')->withFlashSuccess('公司删除成功');
    }

    public function info(Request $request)
    {
        $company = Company::select('id', 'user_id', 'name', 'telephone', 'created_at')->where('name', 'like', "%$request->q%")->paginate();
        return response()->json($company);
    }
}
