<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function indexProduct()
    {
        $products = Product::all();
        //return view('admin.adminProduct')->with('products', $products);
        return view('admin.product.index')->with('products', $products);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsProduct ($id)
    {
        $product = Product::findOrFail($id);
        //return view('admin.updateProduct')->with('product', $product);
        return view('admin.product.update')->with('product', $product);
    }

    /**
     * @param UpdateProductRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduct (UpdateProductRequest $request, $id)
    {
        $params = $request->validated();
        $post = Product::findOrFail($id);
        $post->update($params);
        return redirect()->route('adminProduct');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProduct ($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete('public/'.$product->image);
        $product->delete();
        return back();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createProduct ()
    {
        $categories = Category::all();
        //return view('admin.createProduct')->with('categories', $categories);
        return view('admin.product.create')->with('categories', $categories);
    }

    /**
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProduct (StoreProductRequest $request)
    {
        $params = $request->validated();
        $params['slug'] = Str::slug($params['name'], '-');
        Storage::put('public/products', $params['image']);
        $params['image'] = 'products/'. $params['image']->hashName();
        if(isset($params['promotion'])) {
            $params['price'] = $params['base_price'] - ($params['base_price'] * ($params['promotion']/100));
        } else {
            $params['price'] = $params['base_price'];
        }
        Product::create($params);
        return redirect()->route('adminProduct');
    }
}
