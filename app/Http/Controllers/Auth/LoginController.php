<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\AuthRepositoryContract;
use App\Exceptions\UserInvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Request\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param AuthRepositoryContract $authRepositoryContract
     */

    public function __construct(protected AuthRepositoryContract $authRepositoryContract)
    {
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws UserInvalidCredentialsException
     */
    public function authenticate(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        if ($this->authRepositoryContract->authenticate($credentials)) {
            $accessToken = Auth::user()->createToken('apiToken')->accessToken;

            return response()->json([
                'message' => 'Successfully authenticated',
                'access_token' => $accessToken,
                'user' => Auth::user()->me(),
            ]);
        }

        throw new UserInvalidCredentialsException();
    }

    /**
     * @param Request $request
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authRepositoryContract->logout($request);

        return response()->json([
            'message' => 'Logout successful',
            'user' => Auth::user(),
        ]);
    }
}
