<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\CategoryLogic;
use App\Http\Controllers\Controller;
use App\Model\Age;
use App\Model\Banner;
use App\Model\Brand;
use App\Model\Gift_warping;
use App\Model\Product;

class BannerController extends Controller
{
    public function get_banners(){
        try {
            return response()->json(Banner::active()->get(), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_gift_warping(){
        try {
            return response()->json(Gift_warping::all(), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_brands(){
        try {
            return response()->json(Brand::all(), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products_by_brand($id){
        try {
            return response()->json(Product::where('brand_id',$id)->get(), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_ages(){
        try {
            return response()->json(Age::all(), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products_by_age($id,$gender){
        try {
            return response()->json(Product::where('age_id',$id)->where('gender',$gender)->get(), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}
