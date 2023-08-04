<?php

namespace App\Contracts\User;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Laravel\Passport\PersonalAccessTokenResult;

/**
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $dni
 * @property string $last_name
 * @property string $name
 * @property string $avatar
 * @property string $phone
 *
 */
interface UserContract extends Authenticatable, Authorizable, CanResetPassword
{
    /**
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): void;

    /**
     * @param  array{email:string, dni: string, name: string, last_name: string, nit: string, business_name: string, is_professional: bool, experience: float, fee: float, profession_id: int} $attributes
     * @return void
     */
    public function setAttributes(array $attributes): void;


    /**
     * @param string $name
     * @return PersonalAccessTokenResult
     */
    public function generateToken(string $name): PersonalAccessTokenResult;

    /**
     * @return array
     */
    public function me(): array;
}
