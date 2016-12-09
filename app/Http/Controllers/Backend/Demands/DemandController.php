<?php

namespace App\Http\Controllers\Backend\Demands;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Demands\DemandStoreOrUpdateRequest;
use App\Models\Demand;
use App\Models\User;
use App\Repositories\Backend\Demands\DemandInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class DemandController extends Controller
{
    protected $demands;

    public function __construct(DemandInterface $demands)
    {
        $this->demands = $demands;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.demands.index');
    }

    /**
     * 新闻列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->demands->getForDataTable())
            ->filter(function ($query) use ($request) {
                Demand::demandFilter($query, $request);
            })
            ->addColumn('ids', function ($demands) {
                return $demands->checkbox_button;
            })
            ->editColumn('price', function ($demands) {
                switch ($demands->unit) {
                    case 1:
                        $unit = '只';
                        break;
                    case 2:
                        $unit = '个';
                        break;
                    case 3:
                        $unit = '扎';
                        break;
                    case 4:
                        $unit = '袋';
                        break;
                    case 5:
                        $unit = '箱';
                        break;
                }
                return $demands->quantity.' / '.$unit;
            })
            ->addColumn('actions', function ($demands) {
                return $demands->action_buttons;
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
        return view('backend.demands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DemandStoreOrUpdateRequest $request)
    {
        $this->demands->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.demands.index')->withFlashSuccess('新闻添加成功');
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
    public function edit(Demand $demand)
    {
        $user = User::where('id', $demand->user_id)->first();
        $demand->username = $user->username;
        return view('backend.demands.edit', compact(['demand']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Demand $demand, DemandStoreOrUpdateRequest $request)
    {
        $this->demands->update($demand, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.demands.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->demands->destroy($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.demands.index')->withFlashSuccess('产品删除成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->demands->restore($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.demands.index')->withFlashSuccess('产品恢复成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->demands->delete($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.demands.index')->withFlashSuccess('产品删除成功');
    }
}
