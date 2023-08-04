<?php

namespace App\Models;

use App\Contracts\Pets\PetContract;
use App\Traits\StoreImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model implements PetContract
{
    use HasFactory;
    use StoreImage;

    protected $fillable = [
        'avatar',
        'name',
        'gender',
        'size',
        'weight',
        'vaccination_card',
        'last_vaccination',
        'last_external_parasites',
        'last_deworming',
        'medical_hisotry',
        'race_id',
        'chip_code',
        'user_id',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->imageUrl($this->avatar);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function chip(): BelongsTo
    {
        return $this->belongsTo(Chip::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * get information from pet
     *
     * @return Pet
     */
    public function getInformationPet(): Pet
    {
        return $this->load('race', 'chip');
    }

    /**
     * delete information from pet
     *
     * @return void
     */
    public function destroyMe(): void
    {
        $this->delete();
    }
}
