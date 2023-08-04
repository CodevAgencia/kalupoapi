<?php

namespace App\Http\Request\SingUp;

use App\Objects\Enums\PetTypes;
use App\Repositories\PetTypes\PetTypeRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class SignUpBasicRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
                'confirmed'
            ],
            'polices' => ['required'],
            'pet_type' => ['required', new Enum(PetTypes::class)],
        ];
    }

    public function petType(): int
    {
        $petType = app(PetTypeRepository::class)->findByName($this->string('pet_type'));
        return $petType->id;
    }
    public function authorize(): bool
    {
        return true;
    }
}
