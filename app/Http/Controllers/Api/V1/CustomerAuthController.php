<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Model\BusinessSetting;
use App\Model\EmailVerifications;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerAuthController extends Controller
{
    public function change_points_to_dinar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'points' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        // to make calculation to get mony ..
        $points_dinar = BusinessSetting::where('key', 'points_dinar')->first()->value;
        $money = $request->points / $points_dinar;    //ex.  700/100 = 7 dinar
        //to save data to user table
        $user = User::find($request->user()->id);
        $user->my_points = $user->my_points - $request->points;  //ex.  700 - 700 = 0 points
        $user->my_money = $user->my_money + $money;  // ex.  0 + 7 = 7 dinar
        $user->save();
        return response()->json(true, 200);
    }
    public function points_info(Request $request)
    {
        $dinar_points = BusinessSetting::where('key', 'dinar_points')->first()->value;
        $points_dinar = BusinessSetting::where('key', 'points_dinar')->first()->value;
        $user = User::find($request->user()->id);
        $user->my_points;
        $user->my_money;
        $array = [
            'user_point'     => $user->my_points,
            'user_wallet'    => $user->my_money,
            'dinar_to_points'   => $dinar_points,
        ];
        return response()->json($array, 200);
    }
}
