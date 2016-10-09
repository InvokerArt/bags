<?php

namespace App\Http\Controllers\Backend\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\News\NewsRequest;
use App\Http\Requests\Backend\News\NewsStoreOrUpdateRequest;
use App\Models\Backend\News\CategoriesNews;
use App\Models\Backend\News\News;
use App\Repositories\Backend\News\NewsInterface;
use App\Repositories\Backend\Tags\TagsInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class NewsController extends Controller
{
    protected $news;
    protected $categories;
    protected $tags;

    public function __construct(NewsInterface $news, CategoriesNews $categories, TagsInterface $tags)
    {
        $this->news = $news;
        $this->categories = $categories;
        $this->tags = $tags;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categories->all();
        return view('backend.news.index', compact('categories'));
    }

    /**
     * 新闻列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get(NewsRequest $request)
    {
        return Datatables::of($this->news->getForDataTable())
            ->addColumn('ids', function ($news) {
                return $news->checkbox_button;
            })
            ->addColumn('author', function ($news) {
                return $news->user->name;
            })
            ->addColumn('categories', function ($news) {
                $categories = [];
                foreach ($news->categories as $category) {
                    array_push($categories, $category->name);
                }
                return $categories;
            })
            ->addColumn('tags', function ($news) {
                $tags = [];
                foreach ($news->tags as $tag) {
                    array_push($tags, $tag->name);
                }
                return implode(",", $tags);
            })
            ->addColumn('comments', function ($news) {
                return $news->comments()->count();
            })
            ->addColumn('actions', function ($news) {
                return $news->action_buttons;
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
        $tags = $this->tags->getPopularTags();
        return view('backend.news.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsStoreOrUpdateRequest $request)
    {
        $this->news->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.index')->withFlashSuccess('新闻添加成功');
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
    public function edit(News $news)
    {
        $tags = $this->tags->getPopularTags();
        $newsTags = $news->tags->pluck('name')->all();
        $newsTag = implode(',', $newsTags);
        $categories = $news->categories->pluck('id')->toArray();
        return view('backend.news.edit', compact(['news', 'tags', 'newsTag', 'categories']));
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
