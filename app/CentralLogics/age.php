<?php

namespace App\CentralLogics;

use App\Model\Category;
use App\Model\Product;

class AgeLogic
{
    public static function products($age_id ,$gender )
    {
        if ($age_id == 0) {
            $products = Product::active()->where(function($e)use($gender){
                $e->where('gender',$gender)->orWhere('gender','all');
            })->withCount(['wishlist'])->with(['rating','Ages'])->get();
        }else{
            $products = Product::active()->whereHas('Ages',function($e)use($age_id){
                $e->where('age_id',$age_id);
            })->where(function($e)use($gender){
                $e->where('gender',$gender)->orWhere('gender','all');
            })->withCount(['wishlist'])->with(['rating','Ages'])->get();
        }
        return $products ;  
    }
    public static function barnds($id)
    {
        if ($id == 0) {
            return Product::all();
        }else{
            return Product::with('Ages')->where('brand_id',$id)->get();
        }
    }
}
