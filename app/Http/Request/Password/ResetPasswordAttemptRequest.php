<?php

namespace App\Http\Request\Password;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordAttemptRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
