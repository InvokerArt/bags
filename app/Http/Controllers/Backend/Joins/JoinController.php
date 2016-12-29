<?php

namespace App\Http\Controllers\Backend\Joins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Joins\JoinStoreOrUpdateRequest;
use App\Models\Join;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Backend\Joins\JoinRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class JoinController extends Controller
{
    private $joins;

    public function __construct(JoinRepository $joins)
    {
        $this->joins = $joins;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.joins.index');
    }

    /**
     * Datatable 获取数据
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->joins->getForDataTable())
            ->filter(function ($query) use ($request) {
                Join::joinFilter($query, $request);
            })
            ->addColumn('ids', function ($joins) {
                return $joins->checkbox_button;
            })
            ->editColumn('identity_card', function ($joins) {
                return '<a href="'.$joins->identity_card[0].'" data-toggle="lightbox"><img src="'.$joins->identity_card[0].'" style="max-width:40px;max-height:32px;"></a>';
            })
            ->editColumn('licenses', function ($joins) {
                return '<a href="'.$joins->licenses[0].'" data-toggle="lightbox"><img src="'.$joins->licenses[0].'" style="max-width:40px;max-height:32px;"></a>';
            })
            ->editColumn('status', function ($joins) {
                return $joins->status_button;
            })
            ->addColumn('actions', function ($joins) {
                return $joins->action_buttons;
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
        return view('backend.joins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JoinStoreOrUpdateRequest $request)
    {
        $this->joins->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.joins.index')->withFlashSuccess('加盟添加成功');
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
    public function edit(Join $join)
    {
        $user = User::select('username')->where('id', $join->user_id)->first();
        $company = Company::select('name')->where('id', $join->company_id)->first();
        $join->username = $user->username;
        $join->companyname = $company->name;
        return view('backend.joins.edit', compact('join'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Join $join, JoinStoreOrUpdateRequest $request)
    {
        $this->joins->update($join, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.joins.index')->withFlashSuccess('加盟更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Join $join)
    {
        $this->joins->destroy($join);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.joins.index')->withFlashSuccess('加盟删除成功');
    }
}
