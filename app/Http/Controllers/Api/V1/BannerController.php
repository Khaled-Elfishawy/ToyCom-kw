<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\CategoryLogic;
use App\CentralLogics\AgeLogic;
use App\Http\Controllers\Controller;
use App\Model\Age;
use App\Model\Banner;
use App\Model\Brand;
use App\Model\CardColor;
use App\Model\Gift_warping;
use App\Model\Product;
use App\CentralLogics\Helpers;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function get_banners()
    {
        try {
            return response()->json(Banner::active()->get(), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_gift_warping()
    {
        try {
            $defualt = [
                "id" => 0,
                "name_ar" => "بدون",
                "name_en" => "none",
                "price" => 0,
                "image" => "2021-09-10-613b21a519e7b.png",
                "created_at" => "2021-08-22 15:50:38",
                "updated_at" => "2021-09-06 10:18:15",
            ];
            $data['wraping'] = Gift_warping::all()->prepend($defualt)->sortBy('id');
            $data['card_colors'] = CardColor::where('deleted','0')->orderBy('created_at','desc')->get();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_brands()
    {
        try {
            $defualt = [
                "id" => 0,
                "name_ar" => "الكل",
                "name_en" => "All",
                "image" => "1630923495.png",
                "created_at" => "2021-08-22 15:50:38",
                "updated_at" => "2021-09-06 10:18:15",
            ];
            $brands = Brand::all();
            $brands->prepend($defualt);
            return response()->json($brands->sortBy('order_num'), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products_by_brand(Request $request, $id)
    {
        try {
            $products = AgeLogic::barnds($id, $request['limit'], $request['offset']);
            $products['products'] = Helpers::product_data_formatting($products['products'], true);
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_ages()
    {
        try {
            $defualt = [
                "id" => 0,
                "name_ar" => "الكل",
                "name_en" => "All",
                "image" => "1630923495.png",
                "created_at" => "2021-08-22 15:50:38",
                "updated_at" => "2021-09-06 10:18:15",
            ];
            $ages = Age::orderBy('order_num','asc')->get();
            $ages->prepend($defualt);
            return response()->json($ages, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products_by_age(Request $request, $id, $gender)
    {
        try {
            $products = AgeLogic::products($id, $gender, $request['limit'], $request['offset']);
            $products['products'] = Helpers::product_data_formatting($products['products'], true);
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}
