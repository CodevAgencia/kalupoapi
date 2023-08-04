<?php

namespace App\Contracts\Auth;


use Illuminate\Http\Request;

interface AuthRepositoryContract
{
    /**
     * Auth user.
     * @param  array{email: string, password: string}  $credentials
     * @return bool
     */
    public function authenticate(array $credentials): bool;

    /**
     * @param Request $request
     */
    public function logout(Request $request): void;


    /**
     * @param string $email
     * @return bool
     * Password recovery attempt.
     */
    public function sendResetCode(string $email): bool;

    /***
     * @param string $code
     * @return bool
     * Verify if a reset code is valid.
     */
    public function verifyResetCode(string $code): bool;

    /**
     * @param string $email
     * @return bool
     * Re-send a new reset code.
     */
    public function resendResetCode(string $email): bool;


    /**
     * @param string $code
     * @param string $password
     * @return bool
     */
    public function resetPassword(string $code, string $password): bool;

}
