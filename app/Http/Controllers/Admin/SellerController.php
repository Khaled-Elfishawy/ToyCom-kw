<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Seller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    function index()
    {
        $sellers = Seller::orderBy('created_at')->paginate(10);
        return view('admin-views.seller.index', compact('sellers'));
    }

    function list()
    {
        $sellers=Seller::latest()->paginate();
        return view('admin-views.seller.list',compact('sellers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:sellers',
            'phone' => 'required|unique:sellers',
        ]);

        $seller = new Seller();
        $seller->name = $request->name;
        $seller->email = $request->email;
        $seller->phone = $request->phone;
        $seller->code = GenerateCode('App\Seller','code');
        $seller->save();

        Toastr::success('Seller added successfully!');
        return redirect('admin/seller/list');
    }

    public function edit($id)
    {
        $seller = Seller::find($id);
        return view('admin-views.seller.edit', compact('seller'));
    }


    public function update(Request $request, $id)
    {
        $seller = Seller::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:sellers,email,' . $seller->id,
            'phone' => 'required|unique:sellers,phone,' . $seller->id,

        ]);

        $seller->name = $request->name;
        $seller->email = $request->email;
        $seller->phone = $request->phone;
        $seller->save();
        Toastr::success('Seller updated successfully!');
        return redirect('admin/seller/list');
    }

    public function delete(Request $request)
    {
        $seller = Seller::find($request->id);

        $seller->delete();
        Toastr::success('Seller removed!');
        return back();
    }
}

