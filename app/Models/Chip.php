<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chip extends Model
{
    use HasFactory;

    public $primaryKey = 'code';
    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'phone',
        'responsible',
    ];
}
