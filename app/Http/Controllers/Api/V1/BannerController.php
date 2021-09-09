<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\CategoryLogic;
use App\CentralLogics\AgeLogic;
use App\Http\Controllers\Controller;
use App\Model\Age;
use App\Model\Banner;
use App\Model\Brand;
use App\Model\Gift_warping;
use App\Model\Product;
use App\CentralLogics\Helpers;

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
            $defualt = [
                "id" => 0,
                "name_ar" => "الكل",
                "name_en" => "All",
                "image" => "1630923495.png",
                "created_at" => "2021-08-22 15:50:38",
                "updated_at" => "2021-09-06 10:18:15",
            ];
            $barnds = Brand::all();
            $barnds->prepend($defualt);
            return response()->json($barnds->sortBy('id'), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products_by_brand($id){
        try {
            return response()->json(Helpers::product_data_formatting(AgeLogic::barnds($id), true), 200);

        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_ages(){
        try {
            $defualt = [
                "id" => 0,
                "name_ar" => "الكل",
                "name_en" => "All",
                "image" => "1630923495.png",
                "created_at" => "2021-08-22 15:50:38",
                "updated_at" => "2021-09-06 10:18:15",
            ];
            $ages = Age::all();
            $ages->prepend($defualt);
            return response()->json($ages->sortBy('id'), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products_by_age($id,$gender){
        try {
            return response()->json(Helpers::product_data_formatting(AgeLogic::products($id,$gender), true), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}
