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
if (!function_exists('encryptAES')){
    //AES Encryption Method Starts
    function encryptAES($str,$key) {
        $str = pkcs5_pad($str); 
        $encrypted = openssl_encrypt($str, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $key);
        $encrypted = base64_decode($encrypted);
        $encrypted=unpack('C*', ($encrypted));
      $encrypted=byteArray2Hex($encrypted);
      $encrypted = urlencode($encrypted);
      return $encrypted;
    }
}
if (!function_exists('pkcs5_pad')){
    function pkcs5_pad ($text) {
        $blocksize = 16;
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
}
if (!function_exists('byteArray2Hex')){
    function byteArray2Hex($byteArray) {
        $chars = array_map("chr", $byteArray);
        $bin = join($chars);
        return bin2hex($bin);
    }
}
if (!function_exists('Knetdecrypt')){
    function Knetdecrypt($code,$key) { 
      $code =  hex2ByteArray(trim($code));
      $code=byteArray2String($code);
      $iv = $key; 
      $code = base64_encode($code);
      $decrypted = openssl_decrypt($code, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
      return pkcs5_unpad($decrypted);
    }
}

if (!function_exists('hex2ByteArray')){
    function hex2ByteArray($hexString) {
        $string = hex2bin($hexString);
        return unpack('C*', $string);
    }
}
if (!function_exists('byteArray2String')){
    function byteArray2String($byteArray) {
        $chars = array_map("chr", $byteArray);
        return join($chars);
    }

}
if (!function_exists('pkcs5_unpad')){
    function pkcs5_unpad($text) {
        $pad = ord($text[strlen($text)-1]);
        if ($pad > strlen($text)) {
            return false; 
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }

}



