<?php

namespace App\CentralLogics;

use App\Model\Category;
use App\Model\Product;

class AgeLogic
{
    public static function products($age_id)
    {
        $products = Product::active()->get();
        $product_ids = [];
        foreach ($products as $product) {
            if ($product['age_id'] == $age_id) {
                array_push($product_ids, $product['id']);
            }
        }
        return Product::active()->withCount(['wishlist'])->with('rating')->whereIn('id', $product_ids)->get();
    }
}