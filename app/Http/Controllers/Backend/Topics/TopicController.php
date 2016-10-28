<?php

namespace App\Http\Controllers\Backend\Topics;

use App\Http\Controllers\Controller;
use App\Models\Topics\CategoriesTopics;
use App\Models\Topics\Topic;
use App\Repositories\Backend\Topics\TopicInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TopicController extends Controller
{
    protected $topics;
    protected $categories;

    public function __construct(TopicInterface $topics, CategoriesTopics $categories)
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
