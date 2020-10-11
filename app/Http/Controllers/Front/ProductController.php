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

    public function show($slug, $id){
        $product = [
            "picture" => "http://placehold.it/700x400",
            "price" => 900,
            "name" => "Iphone X",
            "resume" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Huius ego nunc auctoritatem sequens idem faciam. Inde igitur, inquit, ordiendum est. Audeo dicere, inquit. Ut pulsi recurrant?

Peccata paria. Que Manilium, ab iisque M. Non semper, inquam; Si enim ad populum me vocas, eum. At enim hic etiam dolore. Quibusnam praeteritis? Sed nimis multa.

Duo Reges: constructio interrete. Aliter enim explicari, quod quaeritur, non potest. Non quam nostram quidem, inquit Pomponius iocans; Neutrum vero, inquit ille. Non quam nostram quidem, inquit Pomponius iocans; Quid nunc honeste dicit? Quis non odit sordidos, vanos, leves, futtiles?

',
            "category" => ["name" => "Téléphone"]
        ];

        return view('pages.products.show', ['product' => $product]);
    }

    public function testMail(){
        $response = $this->mailerService->sendMail([
            'Email' => 'benjamin.robert90@gmail.com',
            'Name' => 'Benjamin Robert'
        ], 'Test de mail', 'mails.test', ['param' => 'Coucou c\'est moi']);

       dump($response->success(), $response->getData());
       die;
    }

    public function productDetails ($id)
    {
        $user_id = Auth::id(); // si besoin d'avoir ID pour commentaire affichés
        $product = Product::findOrFail($id);
        $comments = Comment::where('product_id', $id)->get();
        return view('pages.product.detailsProduct')->with('product', $product)->with('comments', $comments);
    }
}
