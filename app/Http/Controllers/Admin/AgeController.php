<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\CentralLogics\Helpers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Model\Age;
use App\Model\Product;
use App\Traits\OfferTrait;

class  AgeController extends Controller
{

    use OfferTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ages = Age::all();
        return view('admin-views.age.index', compact('ages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-views.age.create');

    }

    public function store(Request $request)
    {

        $input = $request->all();
        if (!empty($request->file('image'))) {
            $image_data = Helpers::upload('ages/', 'png', $request->image);
        } else {
            $image_data = '';
        }
        $input['image'] = $image_data;
        Age::Create($input);
        return redirect()->route('admin.Age.list');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $age = Age::find($id);
        return view('admin-views.age.edit', compact('age'));
    }


    public function update(Request $request, $id)
    {
        $age = Age::find($id);


        $age->name_ar = $request->name_ar;
        $age->name_en = $request->name_en;
        if (!empty($request->file('image'))) {
            $image_data = Helpers::upload('ages/', 'png', $request->image);
            $age->image = $image_data;
        }
        $age->save();

        return redirect()->route('admin.Age.list');
    }


    public function destroy($id)
    {
        $products = Product::where('age_id', $id)->get();
        if ($products->count() > 0) {
            Toastr::success('Age used in products ... cant delete!');
            return back();
        } else {
            $age = Age::find($id);
            $age->delete();
            Toastr::success('Age deleted successfully!');
            return \redirect()->route('admin.Age.list');
        }
    }
}
