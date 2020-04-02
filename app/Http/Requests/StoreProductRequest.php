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
        return  [
            'product_title' => ['required','string','max:255','unique:products'],
            'product_description' => ['required','string'],
            'product_price' => ['required','numeric'],
            'product_quantity' => ['required','integer'],
            'categories' => ['required'],
            'categories.*' => ['integer'],
        ];
    }

}
