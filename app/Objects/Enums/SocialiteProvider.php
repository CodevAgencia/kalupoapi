<?php

namespace App\Objects\Enums;

enum SocialiteProvider :string
{
    case APPLE = 'apple';
    case TWITTER = 'twitter';
    case FACEBOOK = 'facebook';
    case GOOGLE = 'google';
    case AZURE = 'azure';
    case LOGIN = 'login';
}
