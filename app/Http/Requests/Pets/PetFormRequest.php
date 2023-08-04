<?php

namespace App\Http\Requests\Pets;

use App\Traits\ValidatedFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\ValidationRule;

class PetFormRequest extends FormRequest
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
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
            'gender' => 'required',
            'size' => 'required',
            'weight' => 'required|numeric',
            'vaccination_card' => 'nullable',
            'last_vaccination' => 'nullable',
            'last_external_parasites' => 'nullable',
            'last_deworming' => 'nullable',
            'medical_hisotry' => 'nullable',
            'race_id' => 'required|exists:races,id',
            'chip_code' => 'nullable|exists:chips,code',
        ];
    }
}
