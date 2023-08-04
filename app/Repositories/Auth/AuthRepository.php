<?php

namespace App\Repositories\Auth;

use App\Contracts\Auth\AuthRepositoryContract;
use App\Exceptions\UserDoesNoExistException;
use App\Exceptions\UserResetCodeNotValid;
use App\Models\User;
use App\Models\UserResetCodes;
use App\Notifications\PasswordResetNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthRepository implements AuthRepositoryContract
{
    /**
     * @param  array{email: string, password: string}  $credentials
     * @return bool
     */
    public function authenticate(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    /**
     * @param Request $request
     */
    public function logout(Request $request): void
    {
        Auth::logout();
    }
    /**
     * @throws UserDoesNoExistException
     * @throws Exception
     */
    public function sendResetCode(string $email): bool
    {
        return $this->getUserByEmail($email)->sendResetCode();
    }

    /**
     * @throws UserDoesNoExistException
     */
    private function getUserByEmail(string $email): User
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new UserDoesNoExistException();
        }
        return $user;
    }


    /**
     * @throws UserResetCodeNotValid
     */
    public function verifyResetCode(string $code): bool
    {
        $resetCode = UserResetCodes::where('code', $code)->first();

        if (!$resetCode || $resetCode?->code !== $code || !$resetCode?->isValid()) {
            throw new UserResetCodeNotValid();
        }

        return true;
    }


    /**
     * @throws UserDoesNoExistException
     * @throws Exception
     */
    public function resendResetCode(string $email): bool
    {
        $user = $this->getUserByEmail($email);

        $user->resetCode()?->update([
            'expires_at' => now(), // invalidate current reset code
        ]);

        return $user->generateResetCode(); // generate new reset code
    }


    public function resetPassword(string $code, string $password): bool
    {
        $resetCode = UserResetCodes::where('code', $code)->first();

        $this->verifyResetCode($code);

        $user = $resetCode->user;

        $user->update([
            'password' => Hash::make($password),
        ]);

        $resetCode->update(['used_at' => now()]);

        $user->notify(new PasswordResetNotification($user->name));

        return true;
    }
}
