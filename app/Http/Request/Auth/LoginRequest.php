<?php

namespace App\Http\Request\Auth;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

  /**
   * @return array<string, string[]>
   */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }
}
