<?php

namespace App\Models;

use App\Contracts\PetPqrs\PetPqrsContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetPqrs extends Model implements PetPqrsContract
{
    use HasFactory;

    protected $fillable = [
        'liable',
        'code',
        'pet_id',
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * update a prq.
     * @param array{liable: string, code: string, pet_id: numeric} $attributes
     * @return PetPqrsContract
     */
    public function setAttributes(array $attributes): PetPqrsContract
    {
        $this->update($attributes);
        return $this;
    }

    /**
     * delete a prq.
     * @return void
     */
    public function destroyMe(): void
    {
        $this->delete();
    }
}
