<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profil ($id)
    {
        $user = User::findOrFail($id);
        return view('pages.profil.index')->with('user', $user);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updatePassword($id)
    {
        $user = User::findOrFail($id);
        return view('pages.profil.updatePassword')->with('user', $user);
    }


    /**
     * @param UpdatePasswordRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(UpdatePasswordRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $params = $request->validated();
        $current_password  = Auth::User()->password;
        if(Hash::check($params['current_password'], $current_password))
        {
            $update['password'] = Hash::make($params['new_password']); // verification du mdp dans les rules
            $user->update($update);
        }
        else{
            return back();
        }
        return redirect()->route('profil', ['id' => $id]);
    }
}
