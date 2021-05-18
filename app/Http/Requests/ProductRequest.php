<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => ['required', 'max:50'],
            'image' => ['required', 'url'],
            'categories' => ['required', 'integer'],
            'rating' => ['required', 'in:1,2,3,4,5'],
            'stock' => ['required', 'in:0,1'],
            'description' => ['required', 'max:150'],
            'price' => ['required', 'numeric'],
        ];
    }
}
