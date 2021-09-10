<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\CentralLogics\Helpers;
use App\Model\Gift_warping;
use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Product;
use App\Traits\OfferTrait;

class WrapingController extends Controller
{

    use OfferTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Gift_warping::all();
        return view('admin-views.wraping.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-views.wraping.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if (!empty($request->file('image'))) {
            $image_data =  Helpers::upload('wraping/', 'png', $request->image);
        } else {
            $image_data = '';
        }
        $input['image'] = $image_data;
        Gift_warping::Create($input);
        return redirect()->route('admin.wraping.list');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $data = Gift_warping::find($id);
        return view('admin-views.wraping.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $brand = Gift_warping::find($id);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image'
            ]);
            $image_data =  Helpers::upload('wraping/', 'png', $request->image);
            $brand->image = $image_data;
        }
        $brand->name_ar = $request->name_ar;
        $brand->name_en = $request->name_en;
        $brand->price = $request->price;
        $brand->save();
        return redirect()->route('admin.wraping.list');
    }


    public function destroy($id)
    {
        $wraping = Gift_warping::find($id);
        $wraping->delete();
        return \redirect()->route('admin.wraping.list');
    }
}
