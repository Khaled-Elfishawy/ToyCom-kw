<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Model\Zone;


class CitiesController extends Controller
{
    public function get_cities()
    {
        try {
            $categories = Zone::select('id','name')->with('Cities')->get();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

}
