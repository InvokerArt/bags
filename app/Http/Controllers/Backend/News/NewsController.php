<?php

namespace App\Http\Controllers\Backend\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\News\NewsRequest;
use App\Http\Requests\Backend\News\NewsStoreOrUpdateRequest;
use App\Models\News\CategoriesNews;
use App\Models\News\News;
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
            ->filter(function ($query) use ($request) {
                News::newsFilter($query, $request);
            })
            ->addColumn('ids', function ($news) {
                return $news->checkbox_button;
            })
            ->editColumn('title', function ($news) {
                return str_limit($news->title, 30, '...');
            })
            ->addColumn('author', function ($news) {
                return $news->user->name;
            })
            ->editColumn('categories', function ($news) {
                return $news->categories->map(function ($category) {
                    return $category->name;
                })->implode('<br>');
            })
            ->editColumn('tags', function ($news) {
                return $news->tags->map(function ($tags) {
                    return $tags->name;
                })->implode('、');
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
        return view('backend.news.create', compact(['tags', 'newsTags']));
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
        $newsTags = $news->tags->pluck('name', 'id')->all();
        $categories = $news->categories->pluck('id')->toArray();
        return view('backend.news.edit', compact(['news', 'tags', 'newsTags', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(News $news, NewsStoreOrUpdateRequest $request)
    {
        $this->news->update($news, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->news->destroy($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.index')->withFlashSuccess('新闻删除成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->news->restore($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.index')->withFlashSuccess('新闻删除成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->news->delete($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.index')->withFlashSuccess('新闻删除成功');
    }
}
