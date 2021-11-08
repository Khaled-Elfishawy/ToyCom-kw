<?php

namespace App\Http\Controllers;

use App\Model\BusinessSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Model\Order;
use App\User;

class WalletController extends Controller
{
    public function pay(Request $request)
    {
        $order = Order::with(['details'])->where(['id' => session('order_id')])->first();
        if($order){
            $user  = User::find($order->user_id);
            return view('wallet',compact('order','user'));
        }else{
            return \redirect()->route('payment-fail');
        }
    }
    public function exchange(Request $request)
    {
        $user  = User::find($request->user);
        $order = Order::with(['details'])->where(['id' => $request->order])->first();
        $points_dinar = BusinessSetting::where('key', 'points_dinar')->first()->value;  
        return view('exchange',compact('order','user','points_dinar'));
    }
    public function Doexchange(Request $request)
    {
        $user = User::find($request->user);
        if ($user->my_points >= $request->points) {
            $points_dinar = BusinessSetting::where('key', 'points_dinar')->first()->value;
            $money = $request->points / $points_dinar;    //ex.  700/100 = 7 dinar
            $user->my_points = $user->my_points - $request->points;  //ex.  700 - 700 = 0 points
            $user->my_money = $user->my_money + $money;  // ex.  0 + 7 = 7 dinar
            $user->save();
            return back()->with('success','تم تحويل النقاط بنجاح يمكنك الدفع الأن');
        }else{
            return back()->with('success','نقاطك لا تكفى');
        }
    }
}
