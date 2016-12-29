<?php

namespace App\Http\Controllers\Backend\Topics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Topics\TopicStoreOrUpdateRequest;
use App\Models\CategoriesTopics;
use App\Models\Topic;
use App\Models\User;
use App\Repositories\Backend\Topics\TopicRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TopicController extends Controller
{
    protected $topics;
    protected $categories;

    public function __construct(TopicRepository $topics, CategoriesTopics $categories)
    {
        $this->topics = $topics;
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
        return view('backend.topics.index', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->topics->getForDataTable())
            ->filter(function ($query) use ($request) {
                Topic::topicFilter($query, $request);
            })
            ->addColumn('ids', function ($topics) {
                return $topics->checkbox_button;
            })
            ->editColumn('is_excellent', function ($topics) {
                if ($topics->is_excellent === 'yes') {
                    return '<span class="label lable-sm bg-green">是</span>';
                } else {
                    return '<span class="label lable-sm bg-red">否</span>';
                }
            })
            ->editColumn('is_blocked', function ($topics) {
                if ($topics->is_blocked === 'yes') {
                    return '<span class="label lable-sm bg-green">是</span>';
                } else {
                    return '<span class="label lable-sm bg-red">否</span>';
                }
            })
            ->addColumn('actions', function ($topics) {
                return $topics->action_buttons;
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
        return view('backend.topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicStoreOrUpdateRequest $request)
    {
        $this->topics->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.topics.index')->withFlashSuccess('话题添加成功');
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
    public function edit(Topic $topic)
    {
        $categories = $this->categories->all();
        $user = $topic->user()->select('username')->first();
        $topic->username = $user->username;
        return view('backend.topics.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Topic $topic, TopicStoreOrUpdateRequest $request)
    {
        $this->topics->update($topic, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.topics.index')->withFlashSuccess('话题更新成功');
    }

    /**
     * 回收站
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $this->topics->destroy($topic);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.topics.index')->withFlashSuccess('话题删除成功');
    }

    /**
     * 还原
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Topic $topic)
    {
        $this->topics->restore($topic);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.topics.index')->withFlashSuccess('话题还原成功');
    }

    /**
     * 彻底删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Topic $topic)
    {
        $this->topics->delete($topic);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.topics.index')->withFlashSuccess('话题删除成功');
    }

    public function info(Request $request)
    {
        $topics = Topic::select('id', 'title', 'created_at')->where('title', 'like', "%$request->q%")->paginate();
        return response()->json($topics);
    }
}
