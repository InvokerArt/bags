<?php

namespace App\Http\Controllers\Backend\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Jobs\JobStoreOrUpdateRequest;
use App\Models\Admin;
use App\Models\Job;
use App\Repositories\Backend\Jobs\JobRepository;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Yajra\Datatables\Datatables;

class JobController extends Controller
{
    protected $jobs;
    protected $user;

    public function __construct(JobRepository $jobs, Admin $user)
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
            ->filter(function ($query) use ($request) {
                Job::jobFilter($query, $request);
            })
            ->addColumn('ids', function ($jobs) {
                return $jobs->checkbox_button;
            })
            ->editColumn('content', function ($jobs) {
                return str_limit(strip_tags($jobs->content), 100, '...');
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
    public function edit(Job $job)
    {
        $user = Admin::select('username')->where('id', $job->user_id)->first();
        $job->username = $user->username;
        return view('backend.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Job $job, JobStoreOrUpdateRequest $request)
    {
        $this->jobs->update($job, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.jobs.index')->withFlashSuccess('招聘更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $this->jobs->destroy($job);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.jobs.index')->withFlashSuccess('招聘删除成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Job $job)
    {
        $this->jobs->restore($job);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.jobs.index')->withFlashSuccess('恢复成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Job $job)
    {
        $this->jobs->delete($job);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.jobs.index')->withFlashSuccess('招聘删除成功');
    }
}
