<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'FirstName' => ['required', 'string', 'max:255'],
            'LastName' => ['required', 'string', 'max:255'],
            'Email' => ['required', 'email' ,'string', 'max:255',  Rule::unique('users', 'email')->ignore($this->user['id'])],
            // 'Password' => ['required', Rules\Password::defaults(), Password::min(8)->symbols()->numbers()->letters()],
            // 'ban' => ['required', 'integer'],

        ];
    }
}
