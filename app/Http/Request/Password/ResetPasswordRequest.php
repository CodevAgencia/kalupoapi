<?php

namespace App\Http\Request\Password;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class ResetPasswordRequest extends FormRequest
{
    /**
     * @return array<string, string[]>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(), 'confirmed'],
            'code' => ['required_if:token,==,null'],
            'token' => ['required_if:token,==,null'],
        ];
    }
}
