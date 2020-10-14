<?php

namespace App\Http\Controllers\Front;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use App\Services\MailerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
     * @throws \Throwable
     */
    public function testMail(){
        $response = $this->mailerService->sendMail(
            [
            'Email' => 'benjamin.robert90@gmail.com',
            'Name' => 'Benjamin Robert'
        ], 'Test de mail', 'mails.test', ['param' => 'Coucou c\'est moi']);

       dump($response->success(), $response->getData());
       die;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productDetails ($id)
    {
        $user_id = Auth::id(); // si besoin d'avoir ID pour commentaire affichés
        $product = Product::findOrFail($id);
        $comments = Comment::where('product_id', $id)->get();
        return view('pages.product.detailsProduct')->with('product', $product)->with('comments', $comments);
    }
}
