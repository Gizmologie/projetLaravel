<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list(){
        $products = [
            0 => [
                0 => ["picture" => "http://placehold.it/700x400", "price" => 900, "name" => "Iphone X", "resume" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!", "category" => ["name" => "Téléphone"]],
                1 => ["picture" => "http://placehold.it/700x400", "price" => 15.99, "name" => "Jain - Zanaka", "resume" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!", "category" => ["name" => "Musique"]],
                2 => ["picture" => "http://placehold.it/700x400", "price" => 349, "name" => "Bose - QC35", "resume" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!", "category" => ["name" => "Casque"]],
            ],
            1 => [
                0 => ["name" => "Monopoly classique Hasbro", "resume" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!", "picture" => "http://placehold.it/700x400", "price" => 19.99, "category" => ["name" => "Jouet"]],
                1 => null,
                2 => null
            ]
        ];

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
}
