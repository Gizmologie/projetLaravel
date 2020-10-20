<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexUser()
    {
        $users = User::all();
        //return view('admin.adminUser')->with('users', $users);
        return view('admin.user.index')->with('users', $users);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.update')->with('user', $user);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createUser ()
    {
        return view('admin.user.create');
    }

    /**
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeUser (StoreUserRequest $request)
    {
        $params = $request->validated();
        $params['is_active'] = 0;
        $params['password'] = Hash::make($params['password']);
        $users = User::all();
        User::create($params);
        return redirect()->route('adminUser');
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back();
    }
}
