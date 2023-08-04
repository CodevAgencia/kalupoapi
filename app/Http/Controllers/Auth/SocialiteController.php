<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\SocialAuthRepositoryContract;
use App\Contracts\User\UserRepositoryContract;
use App\Exceptions\UserInvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Request\Auth\CallbackSocialAuthRequest;
use App\Objects\Enums\SocialiteProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class SocialiteController extends Controller
{

    /**
     * @param SocialAuthRepositoryContract $socialAuthRepositoryContract
     * @param UserRepositoryContract $userRepositoryContract
     */
    public function __construct(
        protected SocialAuthRepositoryContract $socialAuthRepositoryContract,
        protected UserRepositoryContract $userRepositoryContract
    ){
    }


    /**
     * @param CallbackSocialAuthRequest $request
     * @return JsonResponse
     * @throws UserInvalidCredentialsException
     */
    public function callback(SocialiteProvider $driver, CallbackSocialAuthRequest $request): JsonResponse
    {
        $token = $request->input('token');

        $socialiteUser = $this->socialAuthRepositoryContract->callbackWithToken($driver, $token);
        $user = $this->userRepositoryContract->forEmail($socialiteUser->getEmail())->first();

        if ($user) {
            Auth::login($user);
            $accessToken = Auth::user()->createToken('apiToken')->accessToken;

            return response()->json([
                'message' => 'Successfully authenticated with ' . $request->input('driver'),
                'access_token' => $accessToken,
                'user' => Auth()->user()->toArray(),
            ]);
        }

        throw new UserInvalidCredentialsException();

    }
}
