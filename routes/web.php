<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/*Route::get('/', function () {
return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/

Route::get('/', 'HomeController@index')->name('home');

Route::get('authentication-failed', function () {
    $errors = [];
    array_push($errors, ['code' => 'auth-001', 'message' => 'Unauthenticated.']);
    return response()->json([
        'errors' => $errors,
    ], 401);
})->name('authentication-failed');

Route::group(['prefix' => 'payment-mobile'], function () {
    Route::get('/', 'PaymentController@payment')->name('payment-mobile');
    Route::get('set-payment-method/{name}', 'PaymentController@set_payment_method')->name('set-payment-method');
});

// SSLCOMMERZ Start
/*Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');*/
Route::post('pay-ssl', 'SslCommerzPaymentController@index');
Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');
Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END

/*paypal*/
//Route::get('/paypal', function (){return view('paypal-test');})->name('paypal');
// Route::post('pay-paypal', 'PaypalPaymentController@payWithpaypal')->name('pay-paypal');
// Route::get('paypal-status', 'PaypalPaymentController@getPaymentStatus')->name('paypal-status');
/*paypal*/
/*paypal*/
/*Route::get('/paypal', function (){return view('paypal-test');})->name('paypal');*/
Route::post('pay-paypal', 'MoyasarController@paywith')->name('pay-paypal');
Route::get('paypal-status', 'MoyasarController@getPaymentStatus')->name('paypal-status');
Route::post('moyasar-oncomplate/{order}', 'MoyasarController@oncomplate')->name('moyasar-oncomplate');
/*paypal*/
Route::post('pay-wallet', 'WalletController@pay')->name('pay-wallet');
Route::post('wallet-exchange', 'WalletController@exchange')->name('wallet-exchange');
Route::post('exchange', 'WalletController@Doexchange')->name('wallet-Doexchange');

/*Route::get('stripe', function (){
return view('stripe-test');
});*/
Route::post('pay-stripe', 'StripePaymentController@paymentProcess')->name('pay-stripe');

// Get Route For Show Payment Form
Route::get('paywithrazorpay', 'RazorPayController@payWithRazorpay')->name('paywithrazorpay');
Route::post('payment-razor', 'RazorPayController@payment')->name('payment-razor');

/*Route::fallback(function () {
return redirect('/admin/auth/login');
});*/

Route::get('payment-success', 'PaymentController@success')->name('payment-success');
Route::get('payment-fail', 'PaymentController@fail')->name('payment-fail');
//Knet
Route::post('knet-response', 'MoyasarController@response')->name('knet-response');
Route::post('knet-error', 'MoyasarController@error')->name('knet-error');
//senang pay
Route::match(['get', 'post'], '/return-senang-pay', 'SenangPayController@return_senang_pay')->name('return-senang-pay');


//paystack
Route::post('/paystack-pay', 'PaystackController@redirectToGateway')->name('paystack-pay');
Route::get('/paystack-callback', 'PaystackController@handleGatewayCallback')->name('paystack-callback');
Route::get('/paystack',function (){
    return view('paystack');
});

Route::get('add-currency', function () {
    $currencies = file_get_contents("installation/currency.json");
    $decoded = json_decode($currencies, true);
    $keep = [];
    foreach ($decoded as $item) {
        array_push($keep, [
            'country'         => $item['name'],
            'currency_code'   => $item['code'],
            'currency_symbol' => $item['symbol_native'],
            'exchange_rate'   => 1,
        ]);
    }
    DB::table('currencies')->insert($keep);
    return response()->json(['ok']);
});

Route::get('/test', function () {
        $permissions = [
            'view_settings',
            'edit_settings',
            'edit_settings',
            'view_settings',
            'view_role',
            'add_role',
            'edit_role',
            'edit_role',
            'view_role',
            'delete_role',
            'view_permission',
            'add_permission',
            'edit_permission',
            'edit_permission',
            'view_permission',
            'delete_permission',
            'view_rolePer',
            'add_rolePer',
            'edit_rolePer',
            'edit_rolePer',
            'view_rolePer',
            'delete_rolePer',
            'view_banner',
            'add_banner',
            'edit_banner',
            'edit_banner',
            'view_banner',
            'view_banner',
            'delete_banner',
            'view_attribute',
            'add_attribute',
            'edit_attribute',
            'edit_attribute',
            'delete_attribute',
            'view_seller',
            'add_seller',
            'edit_seller',
            'edit_seller',
            'delete_seller',
            'view_seller',
            'view_seller',
            'view_branch',
            'add_branch',
            'edit_branch',
            'edit_branch',
            'delete_branch',
            'view_price_group',
            'add_price_group',
            'edit_price_group',
            'edit_price_group',
            'delete_price_group',
            'view_notification',
            'add_notification',
            'edit_notification',
            'edit_notification',
            'view_notification',
            'delete_notification',
            'view_product',
            'add_product',
            'edit_product',
            'edit_product',
            'view_product',
            'delete_product',
            'edit_product',
            'view_product',
            'view_product',
            'edit_product',
            'view_order',
            'view_order',
            'view_order',
            'view_order',
            'edit_order',
            'view_order',
            'edit_order',
            'view_order',
            'view_order',
            'view_order',
            'view_order',
            'view_category',
            'add_category',
            'edit_category',
            'edit_category',
            'add_category',
            'edit_category',
            'delete_category',
            'view_category',
            'view_message',
            'add_message',
            'view_message',
            'view_proPreview',
            'view_proPreview',
            'view_coupon',
            'add_coupon',
            'edit_coupon',
            'edit_coupon',
            'edit_coupon',
            'delete_coupon',
            'view_price_group',
            'add_price_group',
            'edit_price_group',
            'edit_price_group',
            'edit_price_group',
            'delete_price_group',
            'view_settings',
            'edit_settings',
            'view_settings',
            'edit_settings',
            'edit_settings',
            'view_settings',
            'edit_settings',
            'view_settings',
            'edit_settings',
            'view_settings',
            'edit_settings',
            'edit_settings',
            'edit_settings',
            'delete_settings',
            'view_order',
            'view_order',
            'view_order',
            'view_customer',
            'edit_customer',
            'edit_customer',
            'view_customer',
            'view_customer',
            'second_approve',
        ];
        foreach ($permissions as $key => $value) {
            $permissionClass = app(Spatie\Permission\Contracts\Permission::class);
            $permission = $permissionClass::findOrCreate($value, 'admin');
        }

});

// routes for brand



