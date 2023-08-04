<?php

namespace App\Contracts\Products;

use App\Models\Product;

interface ProductContract
{

    /**
     * @return Product
     */
    public function getInformationProduct(): Product;
}
