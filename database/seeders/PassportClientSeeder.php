<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Artisan;

class PassportClientSeeder extends Seeder
{
    public function run()
    {
        Passport::client()->forceFill([
           // 'id' => '966a7fc9-846a-45ae-9ca1-2abe9ecabd8f',
            'user_id' => null,
            'name' => 'Wiu',
            'secret' => "tOGxSJr5wvjIsSbbYDU3Nv5yAqy9PGxqcPIjL7kQ",
            'provider' => 'users',
            'redirect' => 'https://auth.expo.io/@partner/partner',
            'personal_access_client' => false,
            'password_client' => true,
            'revoked' => false,
        ])->saveOrFail();

        Artisan::call('passport:install');
    }
}
