<?php

namespace App\Http\Controllers\Backend\Topics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Topics\ReplyStoreOrUpdateRequest;
use App\Models\Reply;
use App\Repositories\Backend\Topics\ReplyInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ReplyController extends Controller
{
    protected $replies;

    public function __construct(ReplyInterface $replies)
    {
        $this->replies = $replies;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.topics.replies.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->replies->getForDataTable())
            ->filter(function ($query) use ($request) {
                Reply::replyFilter($query, $request);
            })
            ->addColumn('ids', function ($reply) {
                return $reply->checkbox_button;
            })
            ->editColumn('content', function ($reply) {
                return $reply->parent_content;
            })
            ->editColumn('title', function ($reply) {
                return $reply->topic_url;
            })
            ->editColumn('is_blocked', function ($reply) {
                if ($reply->is_blocked === 'yes') {
                    return '<span class="label lable-sm bg-green">是</span>';
                } else {
                    return '<span class="label lable-sm bg-red">否</span>';
                }
            })
            ->addColumn('actions', function ($reply) {
                return $reply->action_buttons;
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
        return view('backend.topics.replies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyStoreOrUpdateRequest $request)
    {
        $this->replies->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.replies.index')->withFlashSuccess('回复添加成功');
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
    public function edit(Reply $reply)
    {
        $user = $reply->user()->select('username')->first();
        $topic = $reply->topic()->select('title')->first();
        $reply->username = $user->username;
        $reply->title = $topic->title;
        return view('backend.topics.replies.edit', compact('reply'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function replyto(Reply $reply)
    {
        $topic = $reply->topic()->select('title')->first();
        $reply->title = $topic->title;
        return view('backend.topics.replies.replyto', compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Reply $reply, ReplyStoreOrUpdateRequest $request)
    {
        $this->replies->update($reply, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.replies.index')->withFlashSuccess('回复更新成功');
    }

    /**
     * 回收站
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->replies->destroy($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.replies.index')->withFlashSuccess('回复删除成功');
    }

    /**
     * 还原
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->replies->restore($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.replies.index')->withFlashSuccess('回复还原成功');
    }

    /**
     * 彻底删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->replies->delete($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.replies.index')->withFlashSuccess('回复删除成功');
    }
}
