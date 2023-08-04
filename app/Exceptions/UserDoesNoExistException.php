<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class UserDoesNoExistException extends Exception
{
    public function render(): HttpResponse
    {
        return response([
            'message' => __('auth.user_no_exists'),
            'errors' => [
                'email' => __('auth.user_no_exists'),
            ],
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
