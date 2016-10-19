<?php

namespace App\Http\Controllers\Backend\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Companies\CompanyRequest;
use App\Models\Backend\Companies\CategoryCompany;
use App\Repositories\Backend\Companies\CompaniesInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CompanyController extends Controller
{
    protected $companies;
    protected $categories;

    public function __construct(CompaniesInterface $companies, CategoryCompany $categories)
    {
        $this->companies = $companies;
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
        return Datatables::of($this->companies->getForDataTable())
            ->filter(function ($query) use ($request) {
                Companies::companiesFilter($query, $request);
            })
            ->addColumn('ids', function ($companies) {
                return $companies->checkbox_button;
            })
            ->editColumn('name', function ($companies) {
                return str_limit($companies->title, 30, '...');
            })
            ->editColumn('categories', function ($companies) {
                return $companies->categories->map(function ($category) {
                    return $category->name;
                })->implode('<br>');
            })
            ->addColumn('actions', function ($companies) {
                return $companies->action_buttons;
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
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        return view('backend.companies.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
