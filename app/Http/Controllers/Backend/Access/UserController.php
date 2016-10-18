<?php

namespace App\Http\Controllers\Backend\Access;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\User\UserRequest;
use App\Repositories\Backend\Access\User\UserInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
    private $users;

    public function __construct(UserInterface $users)
    {
        $this->users = $users;
    }
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
    public function get(Request $request)
    {
        return Datatables::of($this->users->getUserForDataTable())
            ->addColumn('ids', function ($user) {
                return $user->checkbox_button;
            })
            ->addColumn('actions', function ($user) {
                return $user->user_action_buttons;
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
        return view('backend.access.user.create');
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
