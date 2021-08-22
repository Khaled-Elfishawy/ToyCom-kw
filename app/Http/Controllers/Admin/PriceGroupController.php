<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\PriceGroup;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PriceGroupController extends Controller
{
    public function index()
    {
        $prices = PriceGroup::all();
        return view('admin-views.price-group.index', compact('prices'));

//        dd($prices);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:price_groups',
        ], [
            'name.required' => 'Name is required!',
        ]);

        $price = new PriceGroup();
        $price->name = $request->name;
        $price->save();
        Toastr::success('Price-Group added successfully!');
       return back();

        dd($price);
    }

    public function edit($id)
    {
        $price = PriceGroup::find($id);
        return view('admin-views.price-group.edit', compact('price'));
    }

    public function update(Request $request, $id)
    {
        $price = PriceGroup::find($id);

        $request->validate([
            'name' => 'required|unique:price_groups,name,' . $price->id,
        ], [
            'name.required' => 'Name is required!',
        ]);

        $price->name = $request->name;
        $price->save();
        Toastr::success('Price-Group updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $price = PriceGroup::find($request->id);
        $price->delete();
        Toastr::success('Price Group removed!');
        return back();
    }
}

