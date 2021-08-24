<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Brand;
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
        $brands = Brand::all();
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

     $input=$request->all();

     $file_name = $this->saveImage($request->file('image'), 'brand/img' );



     $input['image'] = $file_name;


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

            $file_name = $this->saveImage($request->file('image'), 'brand/img' );

            $brand->image = $file_name;
        }

        $brand->name_ar = $request->name_ar;
        $brand->name_en = $request->name_en;
        $brand->save();

            return redirect()->route('admin.brand.list');
    }


    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return \redirect()->route('admin.brand.list');
    }
}
