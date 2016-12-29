<?php

namespace App\Http\Controllers\Backend\Exhibitions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Exhibitions\ExhibitionRequest;
use App\Http\Requests\Backend\Exhibitions\ExhibitionStoreOrUpdateRequest;
use App\Models\CategoriesExhibitions;
use App\Models\Exhibition;
use App\Repositories\Backend\Exhibitions\ExhibitionRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class ExhibitionController extends Controller
{
    protected $exhibitions;
    protected $categories;

    public function __construct(ExhibitionRepository $exhibitions, CategoriesExhibitions $categories)
    {
        $this->exhibitions = $exhibitions;
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
        return view('backend.exhibitions.index', compact('categories'));
    }

    /**
     * 新闻列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get(ExhibitionRequest $request)
    {
        return Datatables::of($this->exhibitions->getForDataTable())
            ->filter(function ($query) use ($request) {
                Exhibition::exhibitionsFilter($query, $request);
            })
            ->addColumn('ids', function ($exhibitions) {
                return $exhibitions->checkbox_button;
            })
            ->editColumn('title', function ($exhibitions) {
                return str_limit($exhibitions->title, 30, '...');
            })
            ->addColumn('author', function ($exhibitions) {
                return $exhibitions->user->name;
            })
            ->editColumn('categories', function ($exhibitions) {
                return $exhibitions->categories->map(function ($category) {
                    return $category->name;
                })->implode('<br>');
            })
            ->addColumn('actions', function ($exhibitions) {
                return $exhibitions->action_buttons;
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
        return view('backend.exhibitions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExhibitionStoreOrUpdateRequest $request)
    {
        $this->exhibitions->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.exhibitions.index')->withFlashSuccess('新闻添加成功');
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
    public function edit(Exhibition $exhibition)
    {
        $categories = $exhibition->categories->pluck('id')->toArray();
        return view('backend.exhibitions.edit', compact(['exhibition', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Exhibition $exhibition, ExhibitionStoreOrUpdateRequest $request)
    {
        $this->exhibitions->update($exhibition, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.exhibitions.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exhibition $exhibition)
    {
        $this->exhibitions->destroy($exhibition);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.exhibitions.index')->withFlashSuccess('新闻删除成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Exhibition $exhibition)
    {
        $this->exhibitions->restore($exhibition);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.exhibitions.index')->withFlashSuccess('新闻删除成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Exhibition $exhibition)
    {
        $this->exhibitions->delete($exhibition);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.exhibitions.index')->withFlashSuccess('新闻删除成功');
    }
}
