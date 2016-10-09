<?php

namespace App\Http\Controllers\Backend\Access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
    /**
     * 所有用户列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.access.user.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(UserRequest $request)
    {
        return Datatables::of($this->users->getForDataTable())
            ->addColumn('role', function ($user) {
                $roles = [];

                if ($user->roles()->count() > 0) {
                    foreach ($user->roles as $role) {
                        array_push($roles, $role->name);
                    }

                    return implode("<br/>", $roles);
                } else {
                    return '暂无';
                }
            })
            ->addColumn('actions', function ($user) {
                return $user->admin_action_buttons;
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
        //
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
        //
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
