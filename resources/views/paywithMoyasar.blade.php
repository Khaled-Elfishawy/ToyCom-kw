<head>
    <!-- Other Tags -->
    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.2.0/moyasar.css">

    <!-- Moyasar Scripts -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.2.0/moyasar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Download CSS and JS files in case you want to test it locally, but use CDN in production -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<div class="mysr-form"></div>
<script>
    Moyasar.init({
        // Required
        // Specify where to render the form
        // Can be a valid CSS selector and a reference to a DOM element
        element: '.mysr-form',
        language: '{{app()->getLocale()}}',
        // Required
        // Amount in the smallest currency unit
        // For example:
        // 10 SAR = 10 * 100 Halalas
        // 10 KWD = 10 * 1000 Fils
        // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
        amount: "{{$order['order_amount']*100}}",
        metadata: {
            'order_id': "{{$order->id}}"
        },
        // Required
        // Currency of the payment transation
        currency: 'SAR',

        // Required
        // A small description of the current payment process
        description: 'Order From Louz',

        // Required
        publishable_api_key: 'pk_test_eDuHgPzi5izBApLDwUcxVrfTY5X9qeHbTtWNePAr',

        on_completed: function (payment) {
            return new Promise(function (resolve, reject) {
                // savePayment is just an example, your usage may vary.
                $.ajax({
                    type: 'POST',
                    url: "{{url('moyasar-oncomplate/'.$order->id)}}",
                    data: payment,
                    success: function (data, textStatus, jqXHR) {
                        resolve({});
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        reject();
                    }
                });
            });
        },
        // Required
        // This URL is used to redirect the user when payment process has completed
        // Payment can be either a success or a failure, which you need to verify on you system (We will show this in a couple of lines)
        callback_url: "{{url('paypal-status')}}",

        // Optional
        // Required payments methods
        // Default: ['creditcard', 'applepay', 'stcpay']
        methods: [
            'creditcard','stcpay'
        ],
    });
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>