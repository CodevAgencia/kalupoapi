<?php

namespace App\Contracts\Auth;


use App\Objects\Enums\SocialiteProvider;
use Laravel\Socialite\Contracts\User as SocialUser;
use Laravel\Socialite\Two\AbstractProvider;

interface SocialAuthRepositoryContract
{
    /**
     * @param SocialiteProvider $driver
     * @param string $token
     * @return SocialUser
     */
    public function callbackWithToken(SocialiteProvider $driver, string $token): SocialUser;


    /**
     * @param SocialiteProvider $driver
     * @return AbstractProvider
     */
    public function getDriver(SocialiteProvider $driver): AbstractProvider;
}
