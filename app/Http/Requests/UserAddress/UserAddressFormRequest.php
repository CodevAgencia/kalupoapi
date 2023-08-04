<?php

namespace App\Http\Requests\UserAddress;

use App\Traits\ValidatedFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserAddressFormRequest extends FormRequest
{
    use ValidatedFormRequest;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'city' => 'required',
            'prefix_address' => 'required',
            'middle_address' => 'required',
            'end_address' => 'required',
            'additional_information' => 'required',
        ];
    }
}
