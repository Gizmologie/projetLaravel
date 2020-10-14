<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartLine;
use App\Product;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
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

        $cart = Cart::where('user_id','=', $user->id)->first();

        if (!$cart){
            $cart = Cart::create([
                'user_id' => $user->id
            ]);
        }

        $line = CartLine::where('cart_id', '=', $cart->id)->where('product_id', '=', $product->id)->first();

        $create = false;
        if (!$line){
            $line = CartLine::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
            $create = true;
        }elseif ($quantity === 1){
            $quantity = $line->quantity + 1;
        }

        $line->update([
            'quantity' => $quantity
        ]);

        return new JsonResponse([
            'message' => 'Produit ' . ($create ? 'ajouté au panier' : 'mit à jour dans le panier'),
            'quantity' => $quantity
        ], Response::HTTP_OK);

    }

    public function loadCart(Request $request){
        $user = $request->user();

        if (!$user) return new JsonResponse(['total' => 0], Response::HTTP_OK);

        $cart = Cart::where('user_id','=', $user->id)->first();

        if (!$cart) return new JsonResponse(['total' => 0], Response::HTTP_OK);

        $lines = CartLine::where('cart_id', '=', $cart->id)->get();

        return new JsonResponse(['total' => $lines->count()], Response::HTTP_OK);

    }
}
