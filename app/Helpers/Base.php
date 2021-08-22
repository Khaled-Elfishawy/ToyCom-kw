<?php
use App\Model\Permission;
use App\Model\Role;
use Illuminate\Support\Facades\DB;
if (!function_exists('GenerateCode')){
    function GenerateCode($model,$col){
        $codes = $model::all()->pluck($col)->toArray();
        $length = 2;
        $code_str = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        $code_num = rand(100,999);
        $code = ucwords($code_str).$code_num;
        if (in_array($code,$codes)){
            GenerateCode($model,$col);
        }else{
            return $code;
        }

    }
}
if (!function_exists('UserCan')){
    function UserCan($permission,$guard){
        $user = Auth::guard($guard)->user();
        $role = DB::table('model_has_roles')->where('model_id',$user->id)->first();
        $permissions = Role::find($role->role_id)->hasPermissionTo($permission);
        return $permissions;
    }
}
