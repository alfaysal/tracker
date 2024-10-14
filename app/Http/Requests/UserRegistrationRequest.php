<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:60'],
            'email' => ['required', 'max:60', 'email', Rule::unique('users', 'email')],
            'nid' => ['required', 'size:10', Rule::unique('users', 'nid')],
            'password' => ['required', 'confirmed', 'min:6'],
            'vaccine_center_id' => ['required'],
        ];
    }
}
