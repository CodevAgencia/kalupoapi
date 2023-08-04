<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandingPageService extends Model
{
    use HasFactory;

    protected $table = 'landing_page_card_services';

    protected $fillable = [
        'title',
        'image',
        'landing_page_id',
    ];

    public function landingPage(): BelongsTo
    {
        return $this->belongsTo(LandingPage::class);
    }
}
