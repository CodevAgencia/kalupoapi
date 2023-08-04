<?php

namespace App\Contracts;

use App\Models\Profession;
use Illuminate\Support\Enumerable;

/**
 * @template T
 */
interface Repository
{
    /** @return Enumerable<int, T> */
    public function all(): Enumerable;
}
