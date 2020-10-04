<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Product;
use App\User;
use Illuminate\Http\Request;

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

    public function getDetailsUser($id)
    {
        $users = User::where('id', $id)->firstOrFail();
        return view('detailsUser')
            ->with('users', $users)
            ;
    }

    public function detailsUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.detailsUser')->with('user', $user);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        dump($id);
        $user = User::findOrFail($id);
        $user->delete();
        return back();
    }

    public function updateUser(UpdateUserRequest $request, $id)
    {
        $params = $request->validated();
        $post = User::findOrFail($id);
        $post->update($params);
        return redirect()->route('adminUser');
    }
}
