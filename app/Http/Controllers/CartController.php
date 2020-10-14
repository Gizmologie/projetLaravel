<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class CartController extends Controller
{
    public function addLine(Request $request){

        $product_id = $request->request->get('product_id', null);
        $product = Product::where('id', '=', $product_id)->first();

        $quantity = $request->request->get('quantity', 1);

        $user = $request->user();

        if (!$user){
            throw new NotFoundResourceException("Pour le moment, seul un utilisateur connecté peut ajouter articles");
        }

        if (!$product){
            throw new NotFoundResourceException("Ce produit n'existe pas");
        }



        dump($user, $product);
        die;

    }
}
