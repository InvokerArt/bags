<?php

namespace App\Http\Controllers\Backend\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Tags\TagsRequest;
use App\Http\Requests\Backend\Tags\TagsStoreOrUpdateRequest;
use App\Models\Backend\Tags\Tag;
use App\Repositories\Backend\Tags\TagsInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class IndexController extends Controller
{
    protected $tags;

    public function __construct(TagsInterface $tags)
    {
        $this->tags = $tags;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.tags.index');
    }

    /**
     * 新闻列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get(TagsRequest $request)
    {
        return Datatables::of($this->tags->getForDataTable())
            ->filter(function ($query) use ($request) {
                if ($request->has('id')) {
                    $query->where('id', '=', $request->get('id'));
                }

                if ($request->has('name')) {
                    $query->where('name', 'like', "%{$request->get('name')}%");
                }

                if ($request->has('created_from') && !$request->has('created_to')) {
                    $query->where('created_at', '>=', $request->get('created_from'));
                }

                if (!$request->has('created_from') && $request->has('created_to')) {
                    $query->where('created_at', '<=', $request->get('created_to'));
                }

                if ($request->has('created_from') && $request->has('created_to')) {
                    $query->whereBetween('created_at', [$request->get('created_from'),$request->get('created_to')]);
                }
            })
            ->addColumn('ids', function ($tags) {
                return $tags->checkbox_button;
            })
            ->addColumn('count', function ($tags) {
                return $tags->news()->count();
            })
            ->addColumn('actions', function ($tags) {
                return $tags->action_buttons;
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
    public function store(TagsStoreOrUpdateRequest $request)
    {
        $this->tags->create($request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.tags.index')->withFlashSuccess('标签添加成功');
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
    public function edit(Tag $tag)
    {
        return view('backend.tags.edit')
        ->withTag($tag);
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
        $this->tags->update($request, $id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.tags.index')->withFlashSuccess('标签更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tags->destroy($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.tags.index')->withFlashSuccess('标签删除成功');
    }
}
