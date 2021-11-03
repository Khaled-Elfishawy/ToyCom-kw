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
use Alnazer\KnetPayment\Knet;

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

    public function paywith(Request $request)
    {

        $order                  = Order::with(['details'])->where(['id' => session('order_id')])->first();
        $config = [
            "is_test"           => true,
            "tranportal_id"     => "309001",
            "password"          => "309001pg",
            "resource_key"      => "S409HW134YJ9FRE9",
            "response_url"      => route('knet-response'),
            "error_url"         => route('knet-error'),
            "amount"            => $order->order_amount,
            "udf1"              => $order->id,
            "udf2"              => "",
            "udf3"              => "",
            "udf4"              => "",
            "udf5"              => "",
        ];
        $knet  = new Knet($config);
        $request = $knet->request();
//         dd($knet,$request,$order);
        if($request["status"] == 1){
            $order->payment_method = 'K-Net';
            $order->save();
            return redirect()->to($request["data"]["url"]);
        }else{
            print_r($request["errors"]);
        }
    }
    public function response(Request $request)
    {
        $ResTranData            = $request->trandata;
        $termResourceKey        = "S409HW134YJ9FRE9";
        $decrytedData           = Knetdecrypt($ResTranData,$termResourceKey);
        parse_str($decrytedData, $request);
        if($request['result'] == "CAPTURED"){
            DB::table('orders')
                ->where('id', $request['udf1'])
                ->update(['order_status' => 'confirmed', 'payment_status' => 'paid', 'transaction_reference' => $request['paymentid']]);
            $order = Order::find($request['udf1']);
            if ($order->callback != null) {
                return redirect($order->callback . '/success');
            }else{
                return \redirect()->route('payment-success');
            }
        }else{
                return \redirect()->route('payment-fail');
        }
        $order = Order::where('transaction_reference', $payment_id)->first();
        if ($order->callback != null) {
            return redirect($order->callback . '/fail');
        }else{
            return \redirect()->route('payment-fail');
        }
    }
    public function error(Request $request)
    {
        return dd($request);
    }
    // public function getPaymentStatus(Request $request)
    // {
    //     if($request->status == "paid"){
    //         DB::table('orders')
    //             ->where('transaction_reference', $request->id)
    //             ->update(['order_status' => 'confirmed', 'payment_status' => 'paid', 'transaction_reference' => $request->id]);
    //         $order = Order::where('transaction_reference', $request->id)->first();
    //         if ($order->callback != null) {
    //             return redirect($order->callback . '/success');
    //         }else{
    //             return \redirect()->route('payment-success');
    //         }
    //     }
    //     $order = Order::where('transaction_reference', $payment_id)->first();
    //     if ($order->callback != null) {
    //         return redirect($order->callback . '/fail');
    //     }else{
    //         return \redirect()->route('payment-fail');
    //     }
    // }
    // public function oncomplate(Request $request,Order $order)
    // {
    //     DB::table('orders')
    //     ->where('id', $order->id)
    //     ->update([
    //         'transaction_reference' => $request->id,
    //         'payment_method' => 'paypal',
    //         'order_status' => 'failed',
    //         'updated_at' => now()
    //     ]);
    // }
}
