<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'ArabicName' => 'required|max:255',
            'EnglishName' => 'required|max:255',
            'ArabicDescription' => 'required',
            'EnglishDescription' => 'required',
            'ArabicRecovery' => 'nullable',
            'EnglishRecovery' => 'nullable',
            'price'=>'required|numeric',
            'size.*' => 'required',
            'route' => ['required', Rule::unique('products', 'route')->ignore($this->product['id']), 'max:255'],
            'categoryName' => ['nullable', Rule::exists('categories', 'id')],
            'SubCategoryName' => ['nullable', Rule::exists('subcategories', 'id')],
        ];
    }
}
