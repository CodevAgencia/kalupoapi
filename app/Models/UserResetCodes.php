<?php

namespace App\Models;

use App\Objects\Enums\ResetCodeType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserResetCodes extends Model
{

    protected $fillable = [
        'user_id',
        'code',
        'expires_at',
        'created_at',
        'updated_at',
        'used_at',
        'type'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
        'type' => ResetCodeType::class
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function isUsed()
    {
        return $this->used_at !== null;
    }

    public function isExpired()
    {
        return $this->expires_at ? Carbon::make($this->expires_at)?->lt(Carbon::now()) : false;
    }

    public function isValid()
    {
        return !$this->isUsed() && !$this->isExpired();
    }
}
