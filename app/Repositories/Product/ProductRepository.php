<?php

namespace App\Repositories\Product;


use App\Models\Product;
use App\Repositories\Abstracts\Repository;

class ProductRepository extends Repository
{
    /**
     * 当前模块
     */
    public function model()
    {
        return Product::class;
    }


}