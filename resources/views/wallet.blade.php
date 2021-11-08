@php($currency=\App\Model\BusinessSetting::where(['key'=>'currency'])->first()->value)

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- Viewport-->
    {{--<meta name="_token" content="{{csrf_token()}}">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="shortcut icon" href="favicon.ico">
    <!-- Font -->
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/vendor/icon-set/style.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/theme.minc619.css?v=1.0">
    <script
        src="{{asset('public/assets/admin')}}/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js"></script>
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/toastr.css">

    <style>
        .stripe-button-el {
            display: none !important;
        }

        .razorpay-payment-button {
            display: none !important;
        }
    </style>

    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/bootstrap.css">

</head>
<!-- Body-->
<body class="toolbar-enabled">
<!-- Page Content-->
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <div class="col-md-12 mb-5 pt-5">
            <center class="">
                <h1>تأكيد الدفع  عن طريق النقاط</h1>
                <h3>قيمة الطلب</h3>
                <h4>{{$order->order_amount}} KWD</h4>
            </center>
        </div>
        <section class="col-lg-12">
            <div class="checkout_details mt-3">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <label>رصيدك الحالى </label>
                                    <input type="text" disabled value="{{$user->my_money}}">
                                    @if($user->my_money < $order->order_amount)
                                    <small style="color:red;display: block;">رصيدك لا يكفى لسداد قيمة الطلب .</small>
                                    @endif
                                </center>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <label>نقاطك الحالية</label>
                                    <input type="text" disabled value="{{$user->my_points}}">
                                </center>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <form class="needs-validation" method="get" id="payment-form"
                                      action="{{route('wallet-exchange')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user" value="{{$user->id}}">
                                    <input type="hidden" name="order" value="{{$order->id}}">
                                    <button class="btn btn-block btn-warning" type="submit">تحويل نقاط إلى رصيد</button>
                                </form>
                            </div>
                        </div>
                    </div> 
                    @if($user->my_money >= $order->order_amount)
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <form class="needs-validation" method="POST" id="payment-form"
                                      action="{{route('wallet-paynow')}}">
                                    {{ csrf_field() }}
                                    <button class="btn btn-block btn-primary" type="submit">دفع الأن</button>
                                </form>
                            </div>
                        </div>
                    </div>   
                    @endif                 
                </div>
            </div>
        </section>
    </div>
</div>

<!-- JS Front -->
<script src="{{asset('public/assets/admin')}}/js/jquery.js"></script>
<script src="{{asset('public/assets/admin')}}/js/bootstrap.js"></script>
<script src="{{asset('public/assets/admin')}}/js/sweet_alert.js"></script>
<script src="{{asset('public/assets/admin')}}/js/toastr.js"></script>
{!! Toastr::message() !!}

<script>
    setTimeout(function () {
        $('.stripe-button-el').hide();
        $('.razorpay-payment-button').hide();
    }, 10)
</script>

</body>
</html>
