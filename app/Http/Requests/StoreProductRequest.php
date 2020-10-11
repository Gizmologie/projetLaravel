<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            //'slug' => 'required', Créee dabs la méthode
            'base_price' => 'required|numeric',
            'promotion' => 'nullable|numeric',
            //'price' => 'required|numeric', calculé dans la méthode
            'stock_quantity' => 'required',
            'functional_description' => 'required',
            'technical_description' => 'required',
            'image' => 'required|image',
            'available_at' => 'required', // |date strtotime (forme de la date)
        ];
    }
}
