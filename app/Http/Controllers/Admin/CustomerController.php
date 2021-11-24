<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\PriceGroup;
use App\User;
use App\Model\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function customer_list()
    {
        $customers = User::with(['orders'])->latest()->paginate(10);
        return view('admin-views.customer.list', compact('customers'));
    }

    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $customers = User::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('f_name', 'like', "%{$value}%")
                    ->orWhere('l_name', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%")
                    ->orWhere('phone', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin-views.customer.partials._table', compact('customers'))->render()
        ]);
    }

    public function view($id)
    {
        $customer = User::find($id);
        if (isset($customer)) {
            $orders = Order::latest()->where(['user_id' => $id])->paginate(10);
            $price_groups = PriceGroup::all();
            return view('admin-views.customer.edit', compact('customer', 'orders'
                , 'price_groups'));
        }
        Toastr::error('Customer not found!');
        return back();
    }

    public function edit($id)
    {
        $customer = User::find($id);
        $price_groups = PriceGroup::all();
        $orders = Order::latest()->where(['user_id' => $id])->paginate(10);
        return view('admin-views.customer.edit', compact('customer', 'orders', 'price_groups'));

    }

    public function update(Request $request, $id)
    {
        $customer = User::find($id);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->my_points = $request->my_points;
        $customer->my_money = $request->my_money;
        $customer->first_approve = 1;
        $customer->password = ($request->password) ? Hash::make($request['password']) : $customer->password;
        $customer->save();

        if ($customer->is_company == 1) {
            $customer->update([
                $customer->pending_price_group = $request->price_group_id,
            ]);
        }

        Toastr::success('Customer status updated!');
        return back();
    }

    public function second_approve(Request $request)
    {
        $customer = User::find($request->id);
        $customer->second_approve = $request->second_approve;
        $customer->user_group = $customer->pending_price_group;
        $customer->pending_price_group = Null;
        $customer->save();
        Toastr::success('Customer status updated!');
        return back();
    }

    public function admin_list() // for admin
    {
        $admins = Admin::latest()->paginate(10);
        return view('admin-views.admins.list', compact('admins'));
    }

    public function admin_add() // for admin
    {
        return 'hello';

    }

}
