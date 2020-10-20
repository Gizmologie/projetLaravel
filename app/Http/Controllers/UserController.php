<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Order;
use App\User;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profil ()
    {
        return view('pages.profil.index')
            ->with('user', Auth::user());
    }

    public function orderShow($id){
        $user = Auth::user();

        if (!$user){
            return redirect()->route('login');
        }

        $order = Order::where('user_id', '=', $user->id)->where('id', '=', $id)->first();

        if (!$order){
            return redirect()->route('profil');
        }

        return view('pages.profil.order')->with('order', $order);
    }

    public function orderDownload($id){
        $user = Auth::user();

        if (!$user){
            return redirect()->route('login');
        }

        $order = Order::where('user_id', '=', $user->id)->where('id', '=', $id)->first();

        if (!$order){
            return redirect()->route('profil');
        }

        return PDF::loadView('pdf.order', compact('order'))
            ->setWarnings(false)
            ->download(Str::slug('Commande n°' . $order->id) . '.pdf');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updatePassword()
    {
        $user = Auth::user();

        if (!$user){
            return redirect()->route('login');
        }

        return view('pages.profil.updatePassword')->with('user', $user);
    }


    /**
     * @param UpdatePasswordRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (!$user){
            return redirect()->route('login');
        }

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
