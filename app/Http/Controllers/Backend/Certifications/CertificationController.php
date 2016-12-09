<?php

namespace App\Http\Controllers\Backend\Certifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Certifications\CertificationStoreOrUpdateRequest;
use App\Models\Certification;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Backend\Certifications\CertificationInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CertificationController extends Controller
{
    private $certifications;

    public function __construct(CertificationInterface $certifications)
    {
        $this->certifications = $certifications;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.certifications.index');
    }

    /**
     * Datatable 获取数据
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->certifications->getForDataTable())
            ->filter(function ($query) use ($request) {
                Certification::certificationFilter($query, $request);
            })
            ->addColumn('ids', function ($certifications) {
                return $certifications->checkbox_button;
            })
            ->editColumn('identity_card', function ($certifications) {
                return '<a href="'.$certifications->identity_card[0].'" data-toggle="lightbox"><img src="'.$certifications->identity_card[0].'" style="max-width:40px;max-height:32px;"></a>';
            })
            ->editColumn('licenses', function ($certifications) {
                return '<a href="'.$certifications->licenses[0].'" data-toggle="lightbox"><img src="'.$certifications->licenses[0].'" style="max-width:40px;max-height:32px;"></a>';
            })
            ->editColumn('status', function ($certifications) {
                return $certifications->status_button;
            })
            ->addColumn('actions', function ($certifications) {
                return $certifications->action_buttons;
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
        return view('backend.certifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertificationStoreOrUpdateRequest $request)
    {
        $this->certifications->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.certifications.index')->withFlashSuccess('认证添加成功');
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
    public function edit(Certification $certification)
    {
        $user = User::select('username')->where('id', $certification->user_id)->first();
        $company = Company::select('name')->where('id', $certification->company_id)->first();
        $certification->username = $user->username;
        $certification->companyname = $company->name;
        return view('backend.certifications.edit', compact('certification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CertificationStoreOrUpdateRequest $request, Certification $certification)
    {
        $this->certifications->update($certification, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.certifications.index')->withFlashSuccess('认证更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->certifications->destroy($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.certifications.index')->withFlashSuccess('认证删除成功');
    }
}
