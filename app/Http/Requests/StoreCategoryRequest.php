<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'route' => ['required', Rule::unique('categories', 'route'), 'max:255'],
            'upload_image.*' => 'required|image|max:2048',
        ];
    }
    // public function messages()
    // {
    // return [
    //     'ArabicName.required' => __('validation.required'),
    //     'EnglishName.required' => __('validation.required'),
    //     'route.required' => __('validation.required'),
    //     'route.unique' => __('validation.unique'),
    // ];
    // }
}
