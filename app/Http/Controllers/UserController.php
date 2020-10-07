<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profil ($id)
    {
        $user = User::findOrFail($id);
        return view('pages.profil.index')->with('user', $user);
    }
}
