<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartLine;
use App\Enum\CartStateEnum;
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
    /**
     * @var Request
     */
    private $request;

    public function index(Request $request)
    {
        $this->request = $request;

        $cart = $this->getCart();

        return view('pages.cart.index')->with('cart', $cart);
    }

    public function addLine(Request $request){
        $product_id = $request->request->get('product_id', null);
        $product = Product::where('id', '=', $product_id)->first();

        $quantity = $request->request->get('quantity', null);

        $user = $request->user();

        if (!$user){
            throw new NotFoundResourceException("Pour le moment, seul un utilisateur connecté peut ajouter des articles");
        }

        if (!$product){
            throw new NotFoundResourceException("Ce produit n'existe pas");
        }

        $this->request = $request;

        $cart = $this->getCart();

        if (!$cart){
            $cart = Cart::create([
                'user_id' => $user->id,
                'state' => CartStateEnum::$CREATED
            ]);
        }

        $line = CartLine::where('cart_id', '=', $cart->id)->where('product_id', '=', $product->id)->first();


        $create = false;
        if (!$line){
            $line = CartLine::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 0
            ]);
            $create = true;
        }


        if (!$quantity){
            $quantity = $line->quantity + 1;
            $isOutOfStock = ($product->stock_quantity - (1)) < 0;
        }else{
            $isOutOfStock = $line->quantity > $quantity ? false : $product->stock_quantity - ($quantity - $line->quantity ) < 0;
        }

        if ($isOutOfStock){
            return new JsonResponse([
                'message' => 'Le stock n\'est pas suffisant',
                'quantity' => $line->quantity,
                'success' => false
            ], Response::HTTP_OK);
        }



        $product->update([
            'stock_quantity' => $product->stock_quantity - ($quantity - $line->quantity)
        ]);

        $line->update([
            'quantity' => $quantity ? $quantity : ($quantity)
        ]);

        return new JsonResponse([
            'message' => 'Produit ' . ($create ? 'ajouté au panier' : 'mit à jour dans le panier'),
            'quantity' => $quantity,
            'nbObjects' => $cart->getNbObjects(),
            'totalPrice' => $cart->getTotal(),
            'productStock' => $product->stock_quantity,
            'success' => true
        ], Response::HTTP_OK);

    }

    public function deleteLine(Request $request){
        $product_id = $request->request->get('product_id', null);

        $this->request = $request;

        $cart = $this->getCart();

        if (!$cart){
            throw new NotFoundResourceException("Pour le moment, seul un utilisateur connecté peut supprimer des articles");
        }

        $line = CartLine::where('cart_id', '=', $cart->id)->where('product_id', '=', $product_id)->first();

        if (!$line->id){
            return new JsonResponse([
                'message' => 'Impossible de supprimer cette ligne',
                'success' => false
            ], Response::HTTP_FORBIDDEN);
        }

        $product = Product::where('id', '=', $product_id)->first();
        $product->update([
            'stock_quantity' => $product->stock_quantity + $line->quantity
        ]);
        $line->delete();

        return new JsonResponse([
            'message' => 'Ligne supprimée',
            'nbObjects' => $cart->getNbObjects(),
            'totalPrice' => $cart->getTotal(),
            'success' => true
        ], Response::HTTP_OK);
    }

    public function loadCart(Request $request){
        $this->request = $request;

        $cart = $this->getCart();

        if (!$cart) return new JsonResponse(['total' => 0], Response::HTTP_OK);

        return new JsonResponse(['total' => $cart->getNbObjects()], Response::HTTP_OK);
    }

    private function getCart(){
        $user = $this->request->user();

        if (!$user){
            throw new NotFoundResourceException("Pour le moment, seul un utilisateur connecté peut ajouter des articles");
        }

        return Cart::where('user_id','=', $user->id)->where('state', '=', CartStateEnum::$CREATED)->first();
    }

}
