<?php

namespace App\Http\Request\Password;

use Illuminate\Foundation\Http\FormRequest;

class ResendResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
