<?php

namespace App\Http\Controllers\Backend\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Companies\CategoryRequest;
use App\Http\Requests\Backend\Companies\CategoryUpdateRequest;
use App\Models\CategoriesCompanies as Category;
use App\Repositories\Backend\Companies\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * @var CategoryContract
     */
    protected $categories;

    public function __construct(CategoryRepository $categories)
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
        $role = isset($request->role) ? $request->role : 1;
        if ($id) {
            $category = Category::root()->where('role', $role)->find($id);
        } else {
            $category = Category::roots()->where('role', $role)->first();
        }
        return view('backend.companies.category.index', compact(['category', 'role']));
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
        $categories = Category::root()->find($id);
        $children = Category::create(['name' => $name]);
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
    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $this->categories->update($category, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.companies.categories.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->categories->delete($category);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.catalog.categories.index')->withFlashSuccess('删除成功');
    }

    /**
     * @param Request $request
     */
    public function children(Request $request)
    {
        $parent = $request->parent;
        $role = $request->role;
        $disabled = $request->disabled;
        if ($parent == "#") {
            $catetories = Category::roots()->where('role', $role)->get();
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
            $catetories = Category::root()->find($parent)->where('role', $role)->getImmediateDescendants();
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
        $catetorie = Category::root()->find($parent);
        $children = Category::root()->find($id);
        $children->makeChildOf($catetorie);
    }

    public function copy(Request $request)
    {
        $id = $request->id;
        $parent = $request->parent;
        $categories = Category::root()->find($parent);
        $childrens = Category::root()->find($id)->getDescendantsAndSelf();
    }

    public function rename(CategoryRequest $request)
    {
        $id = $request->id;
        $this->categories->update($id, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.companies.categories.index')->withFlashSuccess('重命名成功');
    }
}
