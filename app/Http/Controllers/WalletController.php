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
        $user  = User::find($order->user_id);
        return dd($user);

    }
}
