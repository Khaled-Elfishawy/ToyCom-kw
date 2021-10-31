<?php

namespace App\Http\Controllers\Api\V1;

use App\Age;
use App\CentralLogics\AgeLogic;
use App\CentralLogics\CategoryLogic;
use App\CentralLogics\Helpers;
use App\CentralLogics\ProductLogic;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function get_latest_products(Request $request)
    {
        $products = ProductLogic::get_latest_products($request['limit'], $request['offset']);
        $products['products'] = Helpers::product_data_formatting($products['products'], true);
        return response()->json($products, 200);
    }

    public function get_searched_products(Request $request)
    {
        $result = [];
        $products = Product::active()->get();
        $product_ids = [];
        $sort_from = ($request->sort_type) ? $request->sort_type : 'name';
        $sort = ($request->sort) ? $request->sort : 'asc';
        $limit = ($request->limit) ? $request->limit : '10';
        $offset = ($request->offset) ? $request->offset : '1';
        $max_price = Product::get()->max('price');
//        if ($request->name != null && $request->cat_id == null
//            && $request->age_id == null && $request->age_id == null
//            && $request->price_from == 0.0 && $request->price_to == $max_price) {
//            $products = ProductLogic::search_products($request['name'], $limit, $offset);
//            $products['products'] = Helpers::product_data_formatting($products['products'], true);
//            return response()->json($products, 200);
//        }
//        if ($request->cat_id != null  || $request->age_id != null || $request->price_from != null || $request->price_to != null) {
        $result = Product::query();
        $result = $result->active()->withCount(['wishlist'])->with(['rating', 'Ages']);
        if ($request->age_id != null) {
            $result = $result->whereHas('Ages', function ($q) use ($request) {
                $q->where('age_id', $request->age_id);
            });
        }
        if ($request->cat_id != null) {
            foreach ($products as $product) {
                foreach (json_decode($product['category_ids'], true) as $category) {
                    if ($category['id'] == $request->cat_id) {
                        array_push($product_ids, $product['id']);
                    }
                }
            }
            $result = $result->whereIn('id', $product_ids);
        }
        if ($request->price_from != null && $request->price_to != null) {
            $result = $result->whereBetween('price', [$request->price_from, $request->price_to]);
        }
        if ($request->name != null) {
            $result = $result->Where('name', 'like', "%$request->name%")->orWhere('name', 'like', "%$request->name%");
        }
        $result = $result->orderBy($sort_from, $sort)->paginate($limit, ['*'], 'page', $offset);

        $final_result['total_size'] = $result->total();
        $final_result['limit'] = $limit;
        $final_result['offset'] = $offset;
        $final_result['products'] = $result->items();
        $final_result['products'] = Helpers::product_data_formatting($final_result['products'], true);
        return response()->json($final_result, 200);
    }

    public function get_old_searched_products(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $products = ProductLogic::search_products($request['name'], $request['limit'], $request['offset']);
        $products['products'] = Helpers::product_data_formatting($products['products'], true);
        return response()->json($products, 200);
    }

    public function get_product($id)
    {
        try {
            $product = ProductLogic::get_product($id);
            $product = Helpers::product_data_formatting($product, false);
            return response()->json($product, 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => 'Product not found!'],
            ], 404);
        }
    }

    public function get_related_products($id)
    {
        if (Product::find($id)) {
            $products = ProductLogic::get_related_products($id);
            $products = Helpers::product_data_formatting($products, true);
            return response()->json($products, 200);
        }
        return response()->json([
            'errors' => ['code' => 'product-001', 'message' => 'Product not found!'],
        ], 404);
    }

    public function get_product_reviews($id)
    {
        $reviews = Review::with(['customer'])->where(['product_id' => $id])->get();

        $storage = [];
        foreach ($reviews as $item) {
            $item['attachment'] = json_decode($item['attachment']);
            array_push($storage, $item);
        }

        return response()->json($storage, 200);
    }

    public function get_product_rating($id)
    {
        try {
            $product = Product::find($id);
            $overallRating = ProductLogic::get_overall_rating($product->reviews);
            return response()->json(floatval($overallRating[0]), 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e], 403);
        }
    }

    public function submit_product_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'order_id' => 'required',
            'comment' => 'required',
            'rating' => 'required|numeric|max:5',
        ]);

        $product = Product::find($request->product_id);
        if (isset($product) == false) {
            $validator->errors()->add('product_id', 'There is no such product');
        }

        $multi_review = Review::where(['product_id' => $request->product_id, 'user_id' => $request->user()->id])->first();
        if (isset($multi_review)) {
            $review = $multi_review;
        } else {
            $review = new Review;
        }

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $image_array = [];
        if (!empty($request->file('attachment'))) {
            foreach ($request->file('attachment') as $image) {
                if ($image != null) {
                    if (!Storage::disk('public')->exists('review')) {
                        Storage::disk('public')->makeDirectory('review');
                    }
                    array_push($image_array, Storage::disk('public')->put('review', $image));
                }
            }
        }

        $review->user_id = $request->user()->id;
        $review->product_id = $request->product_id;
        $review->order_id = $request->order_id;
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->attachment = json_encode($image_array);
        $review->save();

        return response()->json(['message' => 'successfully review submitted!'], 200);
    }

    public function get_discounted_products()
    {
        try {
            $products = Helpers::product_data_formatting(Product::active()->withCount(['wishlist'])->with(['rating'])->where('discount', '>', 0)->get(), true);
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => 'Set menu not found!'],
            ], 404);
        }
    }

    public function getFilterData()
    {
        try {
            $data['categories'] = Category::select('id', 'name', 'name_ar')->get();
            $data['ages'] = Age::select('id', 'name_en', 'name_ar')->get();
            $max_price = Product::get()->max('price');
            $data['max_product'] =(string) $max_price;

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['code' => 'data-001', 'message' => 'Data not found!'],
            ], 404);
        }
    }


}

