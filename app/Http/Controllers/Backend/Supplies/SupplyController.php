<?php

namespace App\Http\Controllers\Backend\Supplies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Supplies\SupplyStoreOrUpdateRequest;
use App\Models\Supply;
use App\Models\User;
use App\Repositories\Backend\Supplies\SupplyInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class SupplyController extends Controller
{
    protected $supplies;

    public function __construct(SupplyInterface $supplies)
    {
        $this->supplies = $supplies;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.supplies.index');
    }

    /**
     * 新闻列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->supplies->getForDataTable())
            ->filter(function ($query) use ($request) {
                Supply::supplyFilter($query, $request);
            })
            ->addColumn('ids', function ($supplies) {
                return $supplies->checkbox_button;
            })
            ->editColumn('price', function ($supplies) {
                switch ($supplies->unit) {
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
                return $supplies->price.' / '.$unit;
            })
            ->addColumn('actions', function ($supplies) {
                return $supplies->action_buttons;
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
        return view('backend.supplies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplyStoreOrUpdateRequest $request)
    {
        $this->supplies->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.supplies.index')->withFlashSuccess('新闻添加成功');
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
    public function edit(Supply $supply)
    {
        $user = User::where('id', $supply->user_id)->first();
        $supply->username = $user->username;
        return view('backend.supplies.edit', compact(['supply']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Supply $supply, SupplyStoreOrUpdateRequest $request)
    {
        $this->supplies->update($supply, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.supplies.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->supplies->destroy($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.supplies.index')->withFlashSuccess('产品删除成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->supplies->restore($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.supplies.index')->withFlashSuccess('产品恢复成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->supplies->delete($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.supplies.index')->withFlashSuccess('产品删除成功');
    }
}
