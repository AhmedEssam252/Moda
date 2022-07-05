<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeCheakoutRequest extends FormRequest
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
            'Address' => 'required',
            'Apartment_number' => 'required',
            'City' => 'required',
            'State' => 'required',
            'Postal_Code' => 'required',
            'Country' => 'required',
            'Cash_On_Delivery' => 'required',
        ];
    }
}
