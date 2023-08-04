<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserInvalidCredentialsException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __("auth.invalid_credentials"),
            'errors' => [
                'email' => __("auth.invalid_credentials"),
            ],
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
