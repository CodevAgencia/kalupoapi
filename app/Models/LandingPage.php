<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LandingPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_one',
        'banner_two',
        'title_banner_one',
        'title_banner_two',
        'title_one',
        'title_two',
        'title_three',
    ];

    public function landingPageServices(): HasMany
    {
        return $this->hasMany(LandingPageService::class);
    }

    public function landingPageCards(): HasMany
    {
        return $this->hasMany(LandingPageCard::class);
    }
}
