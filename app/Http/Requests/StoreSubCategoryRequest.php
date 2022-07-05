<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubCategoryRequest extends FormRequest
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
            'route' => ['required', Rule::unique('subcategories', 'route'), 'max:255'],
            'categoryName' => ['required', Rule::exists('categories', 'id')],
            'upload_image.*' => 'required|image',
        ];
    }
}
