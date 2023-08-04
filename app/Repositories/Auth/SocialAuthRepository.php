<?php

namespace App\Repositories\Auth;


use App\Contracts\Auth\SocialAuthRepositoryContract;
use App\Objects\Enums\SocialiteProvider;
use Laravel\Socialite\Contracts\User as SocialUser;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;
use Throwable;


class SocialAuthRepository implements SocialAuthRepositoryContract
{
    /**
     * @param SocialiteProvider $driver
     * @param string $token
     * @return SocialUser
     * @throws Throwable
     */
    public function callbackWithToken(SocialiteProvider $driver, string $token): SocialUser
    {
        return $this->getDriver($driver)->userFromToken($token);
    }

    /**
     * @param SocialiteProvider $driver
     * @return AbstractProvider
     * @throws Throwable
     */
    public function getDriver(SocialiteProvider $driver): AbstractProvider
    {
        $socialDriver = Socialite::driver($driver->value);

        throw_if(! method_exists($socialDriver, 'stateless'), 'Invalid provider, must be stateless.');

        /* @noinspection PhpPossiblePolymorphicInvocationInspection */
        return $socialDriver->stateless();
    }
}
