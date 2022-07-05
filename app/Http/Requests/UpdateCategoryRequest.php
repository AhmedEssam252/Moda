<?php
namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'route' => 'required' , [ Rule::unique('categories', 'route')->ignore($this->category['id']), 'max:255'],
        ];
    }
}
