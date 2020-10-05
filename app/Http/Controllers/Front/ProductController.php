<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use App\Services\MailerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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

    public function list(){
        $data = Product::all();
        $products = [];
        $row = [];
        $cpt = 0;
        $total = 3;
        foreach ($data as $datum) {
            if ($cpt == $total){
                $products[] = $row;
                $cpt = 0;
                $row = [];
            }
            $row[] = $datum;
            $cpt ++;
        }
        if (count($data) % $total !== 0){
            while (count($row) < $total){
                $row[] = null;
            }
            $products[] = $row;
        }

//        dump($products);
//        die;
//
//        $products = [
//            0 => [
////                0 => ["picture" => "http://placehold.it/700x400", "price" => 900, "name" => "Iphone X", "resume" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!", "category" => ["name" => "Téléphone"]],
//                1 => ["picture" => "http://placehold.it/700x400", "price" => 15.99, "name" => "Jain - Zanaka", "resume" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!", "category" => ["name" => "Musique"]],
//                2 => ["picture" => "http://placehold.it/700x400", "price" => 349, "name" => "Bose - QC35", "resume" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!", "category" => ["name" => "Casque"]],
//            ],
//            1 => [
//                0 => ["name" => "Monopoly classique Hasbro", "resume" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!", "picture" => "http://placehold.it/700x400", "price" => 19.99, "category" => ["name" => "Jouet"]],
//                1 => null,
//                2 => null
//            ]
//        ];

        return view('pages.products.list', [
            'products' => $products
        ]);
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
}
