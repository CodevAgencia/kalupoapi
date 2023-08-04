<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\AuthRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Request\Password\ResendResetPasswordRequest;
use App\Http\Request\Password\ResetPasswordAttemptRequest;
use App\Http\Request\Password\ResetPasswordRequest;
use App\Http\Request\Password\VerifyResetCodeRequest;
use Illuminate\Http\JsonResponse;

class PasswordResetController extends Controller
{

    public function __construct(protected AuthRepositoryContract $authRepositoryContract)
    {
    }

    public function sendResetCode(ResetPasswordAttemptRequest $request): JsonResponse
    {
        $this->authRepositoryContract->sendResetCode($request->input('email'));

        return response()->json([
            'message' => 'Reset Code generated successfully',
        ]);
    }

    public function verifyResetPasswordAttempt(VerifyResetCodeRequest $request): JsonResponse
    {
        $this->authRepositoryContract->verifyResetCode($request->input('code'));

        return response()->json([
            'message' => 'Reset Code is valid',
        ]);
    }

    public function resendResetPassword(ResendResetPasswordRequest $request): JsonResponse
    {
        $this->authRepositoryContract->resendResetCode($request->input('email'));

        return response()->json([
            'message' => 'Reset Code verification successfully',
        ]);
    }

    public function resetPasswordCode(ResetPasswordRequest $request): JsonResponse
    {
        $this->authRepositoryContract->resetPassword($request->input('code'), $request->input('password'));

        return response()->json([
            'message' => 'You have reset password successfully',
        ]);
    }
}
