<?php

namespace App\Http\Controllers;

use Moyasar\Moyasar;
use App\CentralLogics\Helpers;
use App\Model\Currency;
use App\Model\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class MoyasarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function paywithMoyasar(Request $request)
    {
        $order = Order::with(['details'])->where(['id' => session('order_id')])->first();
        $tr_ref = Str::random(6) . '-' . rand(1, 1000); 
     
        return view('paywithMoyasar',compact('order'));
    }
    public function getPaymentStatus(Request $request)
    {
        if($request->status == "paid"){
            DB::table('orders')
                ->where('transaction_reference', $request->id)
                ->update(['order_status' => 'confirmed', 'payment_status' => 'paid', 'transaction_reference' => $request->id]);
            $order = Order::where('transaction_reference', $request->id)->first();
            if ($order->callback != null) {
                return redirect($order->callback . '/success');
            }else{
                return \redirect()->route('payment-success');
            }         
        }
        $order = Order::where('transaction_reference', $payment_id)->first();
        if ($order->callback != null) {
            return redirect($order->callback . '/fail');
        }else{
            return \redirect()->route('payment-fail');
        }    
    }
    public function oncomplate(Request $request,Order $order)
    {
        DB::table('orders')
        ->where('id', $order->id)
        ->update([
            'transaction_reference' => $request->id,
            'payment_method' => 'paypal',
            'order_status' => 'failed',
            'updated_at' => now()
        ]);   
    }
}
