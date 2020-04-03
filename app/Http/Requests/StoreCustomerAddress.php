<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerAddress extends FormRequest
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
            'first_name' => ['bail','required','string'],
            'address' => ['bail','required', 'string'],
            'zip_code' => ['bail','required','digits:6'],
            'landmark' => ['bail','required','string','max:500'],
            'mobile_number' => ['bail','required','digits:10'],
        ];
    }
}
