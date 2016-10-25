<?php

namespace App\Http\Controllers\Backend\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Jobs\JobStoreOrUpdateRequest;
use App\Models\Access\User\User;
use App\Repositories\Backend\Jobs\JobInterface;
use Auth;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class JobController extends Controller
{
    protected $jobs;
    protected $user;

    public function __construct(JobInterface $jobs, User $user)
    {
        $this->jobs = $jobs;
        $this->user = $user;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.jobs.index');
    }

    /**
     * 招聘分类
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->jobs->getForDataTable())
            ->addColumn('ids', function ($jobs) {
                return $jobs->checkbox_button;
            })
            ->addColumn('actions', function ($jobs) {
                return $jobs->action_buttons;
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
        return view('backend.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobStoreOrUpdateRequest $request)
    {
        $this->jobs->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.jobs.index')->withFlashSuccess('招聘添加成功');
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
        return view('backend.jobs.edit');
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
        $this->jobs->destroy($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.jobs.index')->withFlashSuccess('招聘删除成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleted($id)
    {
        $this->jobs->delete($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.jobs.index')->withFlashSuccess('招聘删除成功');
    }
}
