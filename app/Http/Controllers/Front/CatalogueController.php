<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogueController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function list(Request $request){

        $categories = $request->query->get('categories', []);

        if ($categories){
            $data = Product::whereIn('category_id', $categories);
        }else{
            $data = Product::where('category_id', '!=', null);
        }

        $selected = [
            'categories' => $categories
        ];

        $data = $data->where('stock_quantity', '>', 0);

        $data = $data->get();

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

        return view('pages.catalogue.list', [
            'products' => $products,
            'categories' => Category::where('level', '=', 1)->get(),
            'selected' => $selected
        ]);
    }
}
