<?php

namespace App\Traits;


use App\Models\UserResetCodes;
use App\Objects\Enums\ResetCodeType;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasResetCodes
{
    public function generateCode(ResetCodeType $codeType, $create = true)
    {
        do {
            $code = random_int(0, 9999);
            $code = str_pad($code, 4, 0, \STR_PAD_LEFT);
        } while (UserResetCodes::where('code', $code)
            ->where('type', $codeType)
            ->whereNotNull('used_at')
            ->first());

        if ($create){
            $this->resetCodes()->create([
                'code' => $code,
                'type' => $codeType,
                'expires_at' => now()->addMinutes(10),
            ]);
        }
        return $code;
    }

    public function resetCodes(): HasMany
    {
        return $this->hasMany(UserResetCodes::class);
    }
}
