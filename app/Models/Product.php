<?php

namespace App\Models;

use App\Contracts\Products\ProductContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model implements ProductContract
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'coins',
        'fav',
        'brand_id',
        'pet_type_id',
        'sub_category_id'
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function petType(): BelongsTo
    {
        return $this->belongsTo(PetType::class);
    }

    public function petAges(): BelongsToMany
    {
        return $this->belongsToMany(PetAge::class);
    }

    public function photoProducts(): HasMany
    {
        return $this->hasMany(PhotoProduct::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function referenceProducts(): HasMany
    {
        return $this->hasMany(ReferenceProduct::class);
    }

    public function getInformationProduct(): Product
    {
        return $this->load('brand', 'referenceProducts', 'petType', 'petAges', 'subCategory');
    }
}
