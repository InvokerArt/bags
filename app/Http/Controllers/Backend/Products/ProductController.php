<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Products\ProductStoreOrUpdateRequest;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Backend\Products\ProductInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class ProductController extends Controller
{
    protected $products;

    public function __construct(ProductInterface $products)
    {
        $this->products = $products;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.products.index');
    }

    /**
     * 新闻列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->products->getForDataTable())
            ->filter(function ($query) use ($request) {
                Product::productsFilter($query, $request);
            })
            ->addColumn('ids', function ($products) {
                return $products->checkbox_button;
            })
            ->editColumn('price', function ($products) {
                switch ($products->unit) {
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
                return $products->price.' / '.$unit;
            })
            ->addColumn('actions', function ($products) {
                return $products->action_buttons;
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
        return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreOrUpdateRequest $request)
    {
        $this->products->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.products.index')->withFlashSuccess('新闻添加成功');
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
    public function edit(Product $product)
    {
        $user = User::where('id', $product->user_id)->first();
        $product->username = $user->username;
        return view('backend.products.edit', compact(['product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, ProductStoreOrUpdateRequest $request)
    {
        $this->products->update($product, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.products.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->products->destroy($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.products.index')->withFlashSuccess('产品删除成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->products->restore($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.products.index')->withFlashSuccess('产品恢复成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->products->delete($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.products.index')->withFlashSuccess('产品删除成功');
    }
}
