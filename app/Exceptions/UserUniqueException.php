<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserUniqueException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __("register.unique"),
            'errors' => [
                'email' => __("register.unique"),
            ],
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
