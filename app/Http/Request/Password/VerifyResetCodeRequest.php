<?php

namespace App\Http\Request\Password;

use Illuminate\Foundation\Http\FormRequest;

class VerifyResetCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'max:4'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
