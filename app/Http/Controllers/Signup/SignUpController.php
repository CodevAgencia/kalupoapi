<?php

namespace App\Http\Controllers\Signup;

use App\Contracts\Auth\AuthRepositoryContract;
use App\Contracts\Auth\SocialAuthRepositoryContract;
use App\Contracts\User\UserRepositoryContract;
use App\Exceptions\UserUniqueException;
use App\Http\Controllers\Controller;
use App\Http\Request\SingUp\SignUpBasicRequest;
use App\Http\Request\SingUp\SignUpSocialRequest;
use App\Objects\Enums\PetTypes;
use App\Objects\Enums\SocialiteProvider;
use App\Repositories\PetTypes\PetTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
    /**
     * @param UserRepositoryContract $userRepositoryContract
     * @param AuthRepositoryContract $authRepositoryContract
     * @param SocialAuthRepositoryContract $socialAuthRepositoryContract
     */
    public function __construct(
        protected UserRepositoryContract $userRepositoryContract,
        protected AuthRepositoryContract $authRepositoryContract,
        protected SocialAuthRepositoryContract $socialAuthRepositoryContract,
        protected PetTypeRepository $petTypeRepository,
    )
    {
    }

    /**
     * @param SignUpBasicRequest $request
     * @return JsonResponse
     */
    public function basic(SignUpBasicRequest $request)
    {

        $user = $this->userRepositoryContract->create([
            'pet_type_id' => $request->petType(),
            ...$request->except('type_pet')
        ]);

        $accessToken = $user->createToken('apiToken')->accessToken;

        return response()->json([
            'success' => true,
            'message' => 'Signed up successful.',
            'access_token' => $accessToken,
            'user'=> $user
        ]);
    }

    /**
     * @param SocialiteProvider $provider
     * @param SignUpSocialRequest $request
     * @return JsonResponse
     * @throws UserUniqueException
     */
    public function socialMedia(SocialiteProvider $provider, SignUpSocialRequest $request)
    {
        $token = $request->string('token');

        $socialiteUser = $this->socialAuthRepositoryContract->callbackWithToken($provider, $token);
        $user = $this->userRepositoryContract->forEmail($socialiteUser->getEmail())->first();

        $pet_type = app(PetTypeRepository::class)->findByName(PetTypes::DOG->name);

        if (!$user) {
            $password = Str::random(40);

            $user = $this->userRepositoryContract->create([
                'password' => Hash::make($password),
                'email' => $socialiteUser->getEmail(),
                'name' => substr($socialiteUser->getEmail(), 0, 2),
                'polices' => true,
                'pet_type_id' => $pet_type->id,
            ]);

            $accessToken = $user->createToken('apiToken')->accessToken;

            return response()->json([
                'success' => true,
                'message' => 'Pre registration successful.',
                'access_token' => $accessToken,
            ]);
        }

        throw new UserUniqueException();
    }
}
