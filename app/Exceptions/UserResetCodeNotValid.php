<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class UserResetCodeNotValid extends Exception
{
    public function render(): HttpResponse
    {
        return response([
            'message' => __("auth.user_code_not_valid"),
            'errors' => [
                'code' =>  __("auth.user_code_not_valid"),
            ],
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
