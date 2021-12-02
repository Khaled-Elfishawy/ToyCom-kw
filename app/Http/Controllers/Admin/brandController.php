<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\CentralLogics\Helpers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Product;
use App\Traits\OfferTrait;

class brandController extends Controller
{

    use OfferTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('order_num','asc')->get();
        return view('admin-views.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-views.brand.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if (!empty($request->file('image'))) {
            $image_data =  Helpers::upload('brand/', 'png', $request->image);
        } else {
            $image_data = '';
        }
        $input['image'] = $image_data;
        Brand::Create($input);
        return redirect()->route('admin.brand.list');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin-views.brand.edit', compact('brand'));
    }
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image'
            ]);
            $image_data =  Helpers::upload('brand/', 'png', $request->image);
            $brand->image = $image_data;
        }
        $brand->name_ar = $request->name_ar;
        $brand->name_en = $request->name_en;
        $brand->order_num = $request->order_num;
        $brand->save();
        return redirect()->route('admin.brand.list');
    }


    public function destroy($id)
    {
        $products = Product::where('brand_id',$id)->get();
        if($products->count() > 0){
            Toastr::success('Brand used in products ... cant delete!');
            return back();
        }else{
            $brand = Brand::find($id);
            $brand->delete();
            Toastr::success('Brand deleted successfully!');
            return \redirect()->route('admin.brand.list');
        }
    }
}
