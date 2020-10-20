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

    /** @var array $results */
    private $results;

    /** @var array $selected */
    private $selected;


    /**
     * @param Request $request
     * @return Factory|View
     */
    public function list(Request $request){

        $this->filter($request);

        $products = [];
        $row = [];
        $cpt = 0;
        $total = 3;

        foreach ($this->results as $datum) {
            if ($cpt == $total){
                $products[] = $row;
                $cpt = 0;
                $row = [];
            }
            $row[] = $datum;
            $cpt ++;
        }

        if (count($this->results) % $total !== 0){
            while (count($row) < $total){
                $row[] = null;
            }
        }
        if (count($row) > 0){
            $products[] = $row;

        }

        return view('pages.catalogue.list', [
            'products' => $products,
            'categories' => Category::where('level', '=', 1)->get(),
            'selected' => $this->selected,
            'paginator' => $this->results,
        ]);
    }

    /**
     * @param Request $request
     */
    private function filter(Request $request){
        $categories = $request->query->get('categories', []);

        $this->selected = [
            'categories' => $categories,
        ];

        if ($categories){
            $this->results = Product::whereIn('category_id', $categories);
        }else{
            $this->results = Product::where('category_id', '!=', null);
        }

        foreach (['price', 'promotion'] as $numberFilter) {
            $value = $request->query->get($numberFilter, []);
            $min = isset($value['min']) ? $value['min'] : null;
            $max = isset($value['max']) ? $value['max'] : null;

            if ($min){
                $this->results = $this->results->where($numberFilter, '>=', $min);
            }

            if ($max){
                $this->results = $this->results->where($numberFilter, '<=', $max);
            }
            $this->selected[$numberFilter] = [
                'min' => $min,
                'max' => $max
            ];
        }



        $this->results = $this->results->where('stock_quantity', '>', 0);

        $this->results = $this->results->orderBy('price');
        $this->results = $this->results->paginate(18);
    }

    public function promotion ()
    {
        $products = Product::whereNotNull('promotion')->get();
        return view('pages.catalogue.promotion')->with('products', $products);
    }
}
