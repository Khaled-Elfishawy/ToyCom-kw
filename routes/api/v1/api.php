<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\V1'], function () {

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('register', 'CustomerAuthController@register');
        Route::post('guest-register', 'CustomerAuthController@guest_register');
        Route::post('login', 'CustomerAuthController@login');
        Route::post('verify-phone', 'CustomerAuthController@verify_phone');
        Route::post('check-email', 'CustomerAuthController@check_email');
        Route::post('verify-email', 'CustomerAuthController@verify_email');
        Route::post('forgot-password', 'PasswordResetController@reset_password_request');
        Route::post('verify-token', 'PasswordResetController@verify_token');
        Route::put('reset-password', 'PasswordResetController@reset_password_submit');
        Route::group(['prefix' => 'delivery-man'], function () {
            Route::post('login', 'DeliveryManLoginController@login');
        });
    });

    Route::group(['prefix' => 'delivery-man'], function () {
        Route::get('profile', 'DeliverymanController@get_profile');
        Route::get('current-orders', 'DeliverymanController@get_current_orders');
        Route::get('all-orders', 'DeliverymanController@get_all_orders');
        Route::post('record-location-data', 'DeliverymanController@record_location_data');
        Route::get('order-delivery-history', 'DeliverymanController@get_order_history');
        Route::put('update-order-status', 'DeliverymanController@update_order_status');
        Route::put('update-payment-status', 'DeliverymanController@order_payment_status_update');
        Route::get('order-details', 'DeliverymanController@get_order_details');
        Route::get('last-location', 'DeliverymanController@get_last_location');
        Route::put('update-fcm-token', 'DeliverymanController@update_fcm_token');

        Route::group(['prefix' => 'reviews', 'middleware' => ['auth:api']], function () {
            Route::get('/{delivery_man_id}', 'DeliveryManReviewController@get_reviews');
            Route::get('rating/{delivery_man_id}', 'DeliveryManReviewController@get_rating');
            Route::post('/submit', 'DeliveryManReviewController@submit_review');
        });
    });

    Route::group(['prefix' => 'config'], function () {
        Route::get('/', 'ConfigController@configuration');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('latest', 'ProductController@get_latest_products');
        Route::get('discounted', 'ProductController@get_discounted_products');
        Route::get('old_search', 'ProductController@get_old_searched_products');
        Route::post('search', 'ProductController@get_searched_products');
        Route::get('details/{id}', 'ProductController@get_product');
        Route::get('related-products/{product_id}', 'ProductController@get_related_products');
        Route::get('reviews/{product_id}', 'ProductController@get_product_reviews');
        Route::get('rating/{product_id}', 'ProductController@get_product_rating');
        Route::post('reviews/submit', 'ProductController@submit_product_review')->middleware('auth:api');
        Route::get('get-filter-data','ProductController@getFilterData');
    });

    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', 'BannerController@get_banners');
    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', 'NotificationController@get_notifications');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@get_categories');
        Route::get('childes/{category_id}', 'CategoryController@get_childes');
        Route::get('products/{category_id}', 'CategoryController@get_products');
        Route::get('products/{category_id}/all', 'CategoryController@get_all_products');
    });

    Route::group(['prefix' => 'customer', 'middleware' => 'auth:api'], function () {
        Route::get('info', 'CustomerController@info');
        Route::put('update-profile', 'CustomerController@update_profile');
        Route::put('cm-firebase-token', 'CustomerController@update_cm_firebase_token');
        Route::post('points_info', 'CustomerAuthController@points_info');
        Route::post('change/points/to/dinar', 'CustomerAuthController@change_points_to_dinar');
        Route::group(['prefix' => 'address'], function () {
            Route::get('list', 'CustomerController@address_list');
            Route::post('add', 'CustomerController@add_new_address');
            Route::put('update/{id}', 'CustomerController@update_address');
            Route::delete('delete', 'CustomerController@delete_address');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('list', 'OrderController@get_order_list');
            Route::get('details', 'OrderController@get_order_details');
            Route::post('place', 'OrderController@place_order');
            Route::put('cancel', 'OrderController@cancel_order');
            Route::get('track', 'OrderController@track_order');
            Route::put('payment-method', 'OrderController@update_payment_method');
        });
        // Chatting
        Route::group(['prefix' => 'message'], function () {
            Route::get('get', 'ConversationController@messages');
            Route::post('send', 'ConversationController@messages_store');
            Route::post('chat-image', 'ConversationController@chat_image');
        });

        Route::group(['prefix' => 'wish-list'], function () {
            Route::get('/', 'WishlistController@wish_list');
            Route::post('add', 'WishlistController@add_to_wishlist');
            Route::delete('remove', 'WishlistController@remove_from_wishlist');
        });
    });

    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', 'BannerController@get_banners');
    });
    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', 'BannerController@get_brands');
        Route::get('/products/{id}', 'BannerController@get_products_by_brand');
    });

    Route::group(['prefix' => 'ages'], function () {
        Route::get('/', 'BannerController@get_ages');
        Route::get('/products/{id}/{gender}', 'BannerController@get_products_by_age');
    });
    Route::group(['prefix' => 'gift'], function () {
        Route::get('/warping', 'BannerController@get_gift_warping');
    });
    Route::get('/get_cities', 'CitiesController@get_cities');

    Route::group(['prefix' => 'coupon', 'middleware' => 'auth:api'], function () {
        Route::get('list', 'CouponController@list');
        Route::get('apply', 'CouponController@apply');
    });
    //timeSlot
    Route::group(['prefix' => 'timeSlot'], function () {
        Route::get('/', 'TimeSlotController@getTime_slot');
    });
});
