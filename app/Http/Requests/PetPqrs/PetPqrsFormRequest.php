<?php

namespace App\Http\Requests\PetPqrs;

use App\Models\Pet;
use App\Traits\ValidatedFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class PetPqrsFormRequest extends FormRequest
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
            'liable' => 'required|string',
            'code' => 'required|string',
            'pet_id' => [
                'required',
                'numeric',
                Rule::exists(Pet::class, 'id')->where(function ($query) {
                    $query->where('user_id', auth()->user()->id);
                }),
            ],
        ];
    }
}
