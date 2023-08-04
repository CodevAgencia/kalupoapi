<?php

namespace App\Http\Requests\Products;

use App\Traits\ValidatedFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\ValidationRule;

class ProductFormRequest extends FormRequest
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
            'offset' => 'nullable|numeric',
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'brand_id' => 'nullable|numeric|exists:brands,id',
            'pet_age_id' => 'nullable|numeric|exists:pet_ages,id',
            'pet_type_id' => 'nullable|numeric|exists:pet_types,id',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'sub_category_id' => 'nullable|numeric|sub_categories:brands,id',
        ];
    }

}
