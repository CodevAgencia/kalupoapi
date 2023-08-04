<?php

namespace App\Models;

use App\Traits\StoreImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\UploadedFile;

class PhotoProduct extends Model
{
    use HasFactory;
    use StoreImage;

    protected $fillable = [
        'product_id',
        'image',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->imageUrl($this->image);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
