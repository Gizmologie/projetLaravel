<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexUser()
    {
        $users = User::all();
        return view('admin.adminUser')->with('users', $users);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexProduct()
    {
        $products = Product::all();
        return view('admin.adminProduct')->with('products', $products);
    }

    /**
     * route possiblement obsolete
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDetailsUser($id)
    {
        $users = User::where('id', $id)->firstOrFail();
        return view('detailsUser')->with('users', $users);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.updateUser')->with('user', $user);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back();
    }

    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(UpdateUserRequest $request, $id)
    {
        $params = $request->validated();
        $post = User::findOrFail($id);
        $post->update($params);
        return redirect()->route('adminUser');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsProduct ($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.updateProduct')->with('product', $product);
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
    public function createUser ()
    {
        return view('admin.createUser');
    }

    /**
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeUser (StoreUserRequest $request)
    {
        $params = $request->validated();
        $params['password'] = Hash::make($params['password']);
        User::create($params);
        return redirect()->route('adminUser');
    }


    public function createProduct ()
    {
        return view('admin.createProduct');
    }

    public function storeProduct (StoreProductRequest $request)
    {
        $params = $request->validated();
        //$request->image->store('image', 'public');
        Storage::put('public/images/products', $params['image']);
        $params['image'] = 'images/products/'. $params['image']->hashName();
        if(isset($params['promotion'])) {
            $params['price'] = $params['base_price'] - ($params['base_price'] * ($params['promotion']/100));
        } else {
            $params['price'] = $params['base_price'];
        }
        Product::create($params);
        return redirect()->route('adminProduct');
    }
}
