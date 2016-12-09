<?php

namespace App\Http\Controllers\Backend\News;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Backend\News\CategoryUpdateRequest;
use App\Http\Requests\Backend\News\CategoryRequest;
use App\Models\CategoriesNews;
use App\Repositories\Backend\News\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * @var CategoryContract
     */
    protected $categories;

    public function __construct(CategoryInterface $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $category = CategoriesNews::root()->find($id);
        } else {
            if (null === CategoriesNews::root()) {
                //生成默认数据
                CategoriesNews::create(['name' => '可降解知识']);
                CategoriesNews::create(['name' => '行业热点']);
            }
            $category = CategoriesNews::roots()->first();
        }
        return view('backend.news.category.index', compact('category'));
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
    public function store(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $categories = CategoriesNews::root()->find($id);
        $children = CategoriesNews::create(['name' => $name]);
        $children->makeChildOf($categories);
        return ['id'=>$children->id, 'icon' => 'fa fa-folder icon-lg icon-state-warning'];
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
    public function update($id, CategoryUpdateRequest $request)
    {
        $this->categories->update($id, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.categories.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categories->delete($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.catalog.categories.index')->withFlashSuccess('删除成功');
    }

    /**
     * @param Request $request
     */
    public function children(Request $request)
    {
        $parent = $request->parent;
        $disabled = $request->disabled;
        if ($parent == "#") {
            $catetories = CategoriesNews::roots()->get();
            foreach ($catetories as $category) {
                $children = $category->children()->get();
                $data[] = array(
                    "id" => $category->id,
                    "text" => $category->name,
                    "icon" => "fa fa-folder icon-lg icon-state-warning",
                    "children" => count($children) ? true : false,
                    "state" => [
                        "disabled" => $disabled ? $category->is_active ? false : true : false
                    ]
                );
            }
        } else {
            $catetories = CategoriesNews::root()->find($parent)->getImmediateDescendants();
            foreach ($catetories as $category) {
                $children = $category->isLeaf();
                $data[] = array(
                    "id" => $category->id,
                    "text" => $category->name,
                    "icon" => "fa fa-folder icon-lg icon-state-warning",
                    "children" => $children ? false : true,
                    "state" => [
                        "disabled" => $disabled ? $category->is_active ? false : true : false
                    ]
                );
            }
        }
        return isset($data) ? $data : null ;
    }

    public function move(Request $request)
    {
        $id = $request->id;
        $parent = $request->parent;
        $catetorie = CategoriesNews::root()->find($parent);
        $children = CategoriesNews::root()->find($id);
        $children->makeChildOf($catetorie);
    }

    public function copy(Request $request)
    {
        $id = $request->id;
        $parent = $request->parent;
        $categories = CategoriesNews::root()->find($parent);
        $childrens = CategoriesNews::root()->find($id)->getDescendantsAndSelf();
    }

    public function rename(CategoryRequest $request)
    {
        $id = $request->id;
        $this->categories->update($id, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.categories.index')->withFlashSuccess('重命名成功');
    }
}
