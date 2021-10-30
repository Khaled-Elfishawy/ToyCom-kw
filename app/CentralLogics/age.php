<?php

namespace App\CentralLogics;

use App\Model\Category;
use App\Model\Product;

class AgeLogic
{
    public static function products($age_id ,$gender ,$limit = 10, $offset = 1)
    {

        if ($age_id == 0) {
            $products = Product::active()->where(function($e)use($gender){
                $e->where('gender',$gender)->orWhere('gender','all');
            })->withCount(['wishlist'])->with(['rating','Ages'])->paginate($limit, ['*'], 'page', $offset);
        }else{
            $products = Product::active()->whereHas('Ages',function($e)use($age_id){
                $e->where('age_id',$age_id);
            })->where(function($e)use($gender){
                $e->where('gender',$gender)->orWhere('gender','all');
            })->withCount(['wishlist'])->with(['rating','Ages'])->paginate($limit, ['*'], 'page', $offset);

        }
        return [
            'total_size' => $products->total(),
            'limit' => $limit,
            'offset' => $offset,
            'products' => $products->items()
        ];
    }
    public static function barnds($id ,$limit = 10, $offset = 1)
    {
        if ($id == 0) {
            $products =  Product::paginate($limit, ['*'], 'page', $offset);
        }else{
            $products = Product::with('Ages')->where('brand_id',$id)->paginate($limit, ['*'], 'page', $offset);
        }
        return [
            'total_size' => $products->total(),
            'limit' => $limit,
            'offset' => $offset,
            'products' => $products->items()
        ];
    }
}
