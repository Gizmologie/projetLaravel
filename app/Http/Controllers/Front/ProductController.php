<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\CartLine;
use App\Comment;
use App\Enum\CartStateEnum;
use App\Http\Controllers\Controller;
use App\Product;
use App\Services\MailerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ProductController extends Controller
{
    /**
     * @var MailerService
     */
    private $mailerService;

    /**
     * ProductController constructor.
     * @param MailerService $mailerService
     */
    public function __construct(MailerService $mailerService)
    {
        $this->mailerService = $mailerService;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productDetails ($category, $slug)
    {
        $user_id = Auth::id(); // si besoin d'avoir ID pour commentaire affichés

        $product = Product::where('slug', '=',$slug)->first();

        if (!$product){
            throw new NotFoundResourceException('Ce produit n\'existe pas.');
        }
        $comments = Comment::where('product_id', $product->id)->get();

        $cart = Cart::where('user_id','=', $user_id)->first();
        if ($cart){
            $line = CartLine::where('cart_id', '=',$cart->id)->where('product_id', '=', $product->id)->first();
        }else{
            $line = null;
        }

        $likes = Product::where('category_id', '=', $product->getCategory()->id)->where('id', '!=', $product->id)->limit(4)->get();
        $productsLike = [];
        foreach ($likes as $like) {
            $productsLike[] = $like;
        }
        while (count($productsLike) < 5){
            $productsLike[] = null;
        }

        return view('pages.product.detailsProduct')
            ->with('product', $product)
            ->with('comments', $comments)
            ->with('likes', $productsLike)
            ->with('total', $line ? $line->quantity : null)
            ;
    }
}
