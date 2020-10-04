<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexUser()
    {
        $users = User::all();
        return view('adminUser')->with('users', $users);
    }

    public function indexProduct()
    {
        $products = Product::all();
        return view('adminProduct')->with('products', $products);
    }
}
