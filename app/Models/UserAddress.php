<?php

namespace App\Models;

use App\Contracts\UserAddress\UserAddressContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model implements UserAddressContract
{
    use HasFactory;

    protected $fillable = [
        'city',
        'prefix_address',
        'middle_address',
        'end_address',
        'additional_information',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function destroyMe(): void
    {
        $this->delete();
    }
}
