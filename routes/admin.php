<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('login', 'LoginController@submit');
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
    /*authentication*/

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', 'SystemController@dashboard')->name('dashboard');
        Route::get('settings', 'SystemController@settings')->name('settings')->middleware('permission:view_settings');
        Route::post('settings', 'SystemController@settings_update')->middleware('permission:edit_settings');
        Route::post('settings-password', 'SystemController@settings_password_update')->name('settings-password')->middleware('permission:edit_settings');
        Route::get('/get-restaurant-data', 'SystemController@restaurant_data')->name('get-restaurant-data')->middleware('permission:view_settings');


        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::get('add-new', 'RoleController@index')->name('add-new')->middleware('permission:view_role');
            Route::post('store', 'RoleController@store')->name('store')->middleware('permission:add_role');
            Route::get('edit/{id}', 'RoleController@edit')->name('edit')->middleware('permission:edit_role');
            Route::put('update/{id}', 'RoleController@update')->name('update')->middleware('permission:edit_role');
            Route::get('list', 'RoleController@list')->name('list')->middleware('permission:view_role');
            Route::delete('delete/{id}', 'RoleController@delete')->name('delete')->middleware('permission:delete_role');
        });

        Route::group(['prefix' => 'permission', 'as' => 'permission.'], function () {
            Route::get('add-new', 'PermissionController@index')->name('add-new')->middleware('permission:view_permission');
            Route::post('store', 'PermissionController@store')->name('store')->middleware('permission:add_permission');
            Route::get('edit/{id}', 'PermissionController@edit')->name('edit')->middleware('permission:edit_permission');
            Route::put('update/{id}', 'PermissionController@update')->name('update')->middleware('permission:edit_permission');
            Route::get('list', 'PermissionController@list')->name('list')->middleware('permission:view_permission');
            Route::delete('delete/{id}', 'PermissionController@delete')->name('delete')->middleware('permission:delete_permission');
        });

        Route::group(['prefix' => 'rolePer', 'as' => 'rolePer.'], function () {
            Route::get('add-new', 'RolePermissionController@index')->name('add-new')->middleware('permission:view_rolePer');
            Route::post('store', 'RolePermissionController@store')->name('store')->middleware('permission:add_rolePer');
            Route::get('edit/{id}', 'RolePermissionController@edit')->name('edit')->middleware('permission:edit_rolePer');
            Route::put('update/{id}', 'RolePermissionController@update')->name('update')->middleware('permission:edit_rolePer');
            Route::get('list', 'RolePermissionController@list')->name('list')->middleware('permission:view_rolePer');
            Route::delete('delete/{id}', 'RolePermissionController@delete')->name('delete')->middleware('permission:delete_rolePer');
        });

        Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {

            Route::get('add-new', 'BannerController@index')->name('add-new')->middleware('permission:view_banner');
            Route::post('store', 'BannerController@store')->name('store')->middleware('permission:add_banner');
            Route::get('edit/{id}', 'BannerController@edit')->name('edit')->middleware('permission:edit_banner');
            Route::put('update/{id}', 'BannerController@update')->name('update')->middleware('permission:edit_banner');
            Route::get('list', 'BannerController@list')->name('list')->middleware('permission:view_banner');
            Route::get('status/{id}/{status}', 'BannerController@status')->name('status')->middleware('permission:view_banner');
            Route::delete('delete/{id}', 'BannerController@delete')->name('delete')->middleware('permission:delete_banner');
        });

        Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
            Route::get('list', 'brandController@index')->name('list');
            Route::get('add-new', 'brandController@create')->name('add-new');
            Route::post('store', 'brandController@store')->name('store');
            Route::get('edit/{id}', 'brandController@edit')->name('edit');
            Route::put('update/{id}', 'brandController@update')->name('update');
            Route::delete('delete/{id}', 'brandController@destroy')->name('delete');
        });
        Route::group(['prefix' => 'wraping', 'as' => 'wraping.'], function () {
            Route::get('list', 'WrapingController@index')->name('list');
            Route::get('add-new', 'WrapingController@create')->name('add-new');
            Route::post('store', 'WrapingController@store')->name('store');
            Route::get('edit/{id}', 'WrapingController@edit')->name('edit');
            Route::put('update/{id}', 'WrapingController@update')->name('update');
            Route::delete('delete/{id}', 'WrapingController@destroy')->name('delete');
        });
        Route::group(['prefix' => 'card_colors', 'as' => 'card_colors.'], function () {
            Route::get('list', 'CardColorsController@index')->name('list');
            Route::get('add-new', 'CardColorsController@create')->name('add-new');
            Route::post('store', 'CardColorsController@store')->name('store');
            Route::get('edit/{id}', 'CardColorsController@edit')->name('edit');
            Route::post('update/{id}', 'CardColorsController@update')->name('update');
            Route::delete('delete/{id}', 'CardColorsController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'Age', 'as' => 'Age.'], function () {

            Route::get('list', 'AgeController@index')->name('list');
            Route::get('add-new', 'AgeController@create')->name('add-new');
            Route::post('store', 'AgeController@store')->name('store');
            Route::get('edit/{id}', 'AgeController@edit')->name('edit');
            Route::put('update/{id}', 'AgeController@update')->name('update');
            Route::delete('delete/{id}', 'AgeController@destroy')->name('delete');


        });






//        Route::group(['prefix' => 'attribute', 'as' => 'attribute.'], function () {
//            Route::get('add-new', 'AttributeController@index')->name('add-new')->middleware('permission:view_attribute');
//            Route::post('store', 'AttributeController@store')->name('store')->middleware('permission:add_attribute');
//            Route::get('edit/{id}', 'AttributeController@edit')->name('edit')->middleware('permission:edit_attribute');
//            Route::post('update/{id}', 'AttributeController@update')->name('update')->middleware('permission:edit_attribute');
//            Route::delete('delete/{id}', 'AttributeController@delete')->name('delete')->middleware('permission:delete_attribute');
//        });

            Route::group(['prefix' => 'seller', 'as' => 'seller.'], function () {
                Route::get('add-new', 'SellerController@index')->name('add-new')->middleware('permission:view_seller');
                Route::post('store', 'SellerController@store')->name('store')->middleware('permission:add_seller');
                Route::get('edit/{id}', 'SellerController@edit')->name('edit')->middleware('permission:edit_seller');
                Route::put('update/{id}', 'SellerController@update')->name('update')->middleware('permission:edit_seller');
                Route::delete('delete/{id}', 'SellerController@delete')->name('delete')->middleware('permission:delete_seller');
                Route::get('list', 'SellerController@list')->name('list')->middleware('permission:view_seller');
                Route::get('status/{id}/{status}', 'SellerController@status')->name('status')->middleware('permission:view_seller');
            });

        Route::group(['prefix' => 'branch', 'as' => 'branch.'], function () {
            Route::get('add-new', 'BranchController@index')->name('add-new')->middleware('permission:view_branch');
            Route::post('store', 'BranchController@store')->name('store')->middleware('permission:add_branch');
            Route::get('edit/{id}', 'BranchController@edit')->name('edit')->middleware('permission:edit_branch');
            Route::post('update/{id}', 'BranchController@update')->name('update')->middleware('permission:edit_branch');
            Route::delete('delete/{id}', 'BranchController@delete')->name('delete')->middleware('permission:delete_branch');
        });

        Route::group(['prefix' => 'price-group', 'as' => 'price-group.'], function () {
            Route::get('add-new', 'PriceGroupController@index')->name('add-new')->middleware('permission:view_price_group');
            Route::post('store', 'PriceGroupController@store')->name('store')->middleware('permission:add_price_group');
            Route::get('edit/{id}', 'PriceGroupController@edit')->name('edit')->middleware('permission:edit_price_group');
            Route::post('update/{id}', 'PriceGroupController@update')->name('update')->middleware('permission:edit_price_group');
            Route::delete('delete/{id}', 'PriceGroupController@delete')->name('delete')->middleware('permission:delete_price_group');
        });

//        Route::group(['prefix' => 'delivery-man', 'as' => 'delivery-man.'], function () {
//            Route::get('add', 'DeliveryManController@index')->name('add');
//            Route::post('store', 'DeliveryManController@store')->name('store');
//            Route::get('list', 'DeliveryManController@list')->name('list');
//            Route::get('preview/{id}', 'DeliveryManController@preview')->name('preview');
//            Route::get('edit/{id}', 'DeliveryManController@edit')->name('edit');
//            Route::post('update/{id}', 'DeliveryManController@update')->name('update');
//            Route::delete('delete/{id}', 'DeliveryManController@delete')->name('delete');
//            Route::post('search', 'DeliveryManController@search')->name('search');
//
           Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], function () {
               Route::get('list', 'DeliveryManController@reviews_list')->name('list');
           });
//        });

//        Route::group(['prefix' => 'notification', 'as' => 'notification.'], function () {
//            Route::get('add-new', 'NotificationController@index')->name('add-new')->middleware('permission:view_notification');
//            Route::post('store', 'NotificationController@store')->name('store')->middleware('permission:add_notification');
//            Route::get('edit/{id}', 'NotificationController@edit')->name('edit')->middleware('permission:edit_notification');
//            Route::post('update/{id}', 'NotificationController@update')->name('update')->middleware('permission:edit_notification');
//            Route::get('status/{id}/{status}', 'NotificationController@status')->name('status')->middleware('permission:view_notification');
//            Route::delete('delete/{id}', 'NotificationController@delete')->name('delete')->middleware('permission:delete_notification');
//        });

        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('add-new', 'ProductController@index')->name('add-new')->middleware('permission:view_product');
            Route::post('variant-combination', 'ProductController@variant_combination')->name('variant-combination');
            Route::post('store', 'ProductController@store')->name('store')->middleware('permission:add_product');
            Route::get('edit/{id}', 'ProductController@edit')->name('edit')->middleware('permission:edit_product');
            Route::post('update/{id}', 'ProductController@update')->name('update')->middleware('permission:edit_product');
            Route::get('list', 'ProductController@list')->name('list')->middleware('permission:view_product');
            Route::delete('delete/{id}', 'ProductController@delete')->name('delete')->middleware('permission:delete_product');
            Route::get('status/{id}/{status}', 'ProductController@status')->name('status')->middleware('permission:edit_product');
            Route::post('search', 'ProductController@search')->name('search')->middleware('permission:view_product');

            Route::get('view/{id}', 'ProductController@view')->name('view')->middleware('permission:view_product');
            Route::get('remove-image/{id}/{name}', 'ProductController@remove_image')->name('remove-image')->middleware('permission:edit_product');
            //ajax request
            Route::get('get-categories', 'ProductController@get_categories')->name('get-categories');
        });

        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
            Route::get('list/{status}', 'OrderController@list')->name('list')->middleware('permission:view_order');
            Route::get('details/{id}', 'OrderController@details')->name('details')->middleware('permission:view_order');
            Route::get('status', 'OrderController@status')->name('status')->middleware('permission:view_order');
//            Route::get('add-delivery-man/{order_id}/{delivery_man_id}', 'OrderController@add_delivery_man')->name('add-delivery-man');
            Route::get('payment-status', 'OrderController@payment_status')->name('payment-status')->middleware('permission:view_order');
            Route::post('productStatus', 'OrderController@productStatus')->name('productStatus')->middleware('permission:edit_order');
            Route::get('generate-invoice/{id}', 'OrderController@generate_invoice')->name('generate-invoice')->middleware('permission:view_order');
            Route::post('add-payment-ref-code/{id}', 'OrderController@add_payment_ref_code')->name('add-payment-ref-code')->middleware('permission:edit_order');
            Route::get('branch-filter/{branch_id}', 'OrderController@branch_filter')->name('branch-filter')->middleware('permission:view_order');
            Route::get('user-filter/{branch_id}', 'OrderController@user_filter')->name('user-filter')->middleware('permission:view_order');
            Route::post('date-search', 'OrderController@date_search')->name('date_search')->middleware('permission:view_order');
            Route::post('time-search', 'OrderController@time_search')->name('time_search')->middleware('permission:view_order');
            Route::post('search', 'OrderController@search')->name('search')->middleware('permission:view_order');
        });

        Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
            Route::get('list/{status}', 'OrderController@list')->name('list');
            Route::put('status-update/{id}', 'OrderController@status')->name('status-update');
            Route::get('view/{id}', 'OrderController@view')->name('view');
            Route::post('update-shipping/{id}', 'OrderController@update_shipping')->name('update-shipping');
            Route::post('update-timeSlot', 'OrderController@update_time_slot')->name('update-timeSlot');
            Route::post('printCard', 'OrderController@printCard')->name('printCard');
            Route::post('update-deliveryDate', 'OrderController@update_deliveryDate')->name('update-deliveryDate');

            Route::delete('delete/{id}', 'OrderController@delete')->name('delete');
        });

        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('add', 'CategoryController@index')->name('add')->middleware('permission:view_category');
//            Route::get('add-sub-category', 'CategoryController@sub_index')->name('add-sub-category');
//            Route::get('add-sub-sub-category', 'CategoryController@sub_sub_index')->name('add-sub-sub-category');
            Route::post('store', 'CategoryController@store')->name('store')->middleware('permission:add_category');
            Route::get('edit/{id}', 'CategoryController@edit')->name('edit')->middleware('permission:edit_category');
            Route::post('update/{id}', 'CategoryController@update')->name('update')->middleware('permission:edit_category');
            Route::post('store', 'CategoryController@store')->name('store')->middleware('permission:add_category');
            Route::get('status/{id}/{status}', 'CategoryController@status')->name('status')->middleware('permission:edit_category');
            Route::delete('delete/{id}', 'CategoryController@delete')->name('delete')->middleware('permission:delete_category');
            Route::post('search', 'CategoryController@search')->name('search')->middleware('permission:view_category');
        });

//        Route::group(['prefix' => 'message', 'as' => 'message.'], function () {
//            Route::get('list', 'ConversationController@list')->name('list')->middleware('permission:view_message');
//            Route::post('store/{user_id}', 'ConversationController@store')->name('store')->middleware('permission:add_message');
//            Route::get('view/{user_id}', 'ConversationController@view')->name('view')->middleware('permission:view_message');
//        });

//        Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], function () {
//            Route::get('list', 'ReviewsController@list')->name('list')->middleware('permission:view_proPreview');
//            Route::post('search', 'ReviewsController@search')->name('search')->middleware('permission:view_proPreview');
//        });

//        Route::group(['prefix' => 'coupon', 'as' => 'coupon.'], function () {
//            Route::get('add-new', 'CouponController@add_new')->name('add-new')->middleware('permission:view_coupon');
//            Route::post('store', 'CouponController@store')->name('store')->middleware('permission:add_coupon');
//            Route::get('update/{id}', 'CouponController@edit')->name('update')->middleware('permission:edit_coupon');
//            Route::post('update/{id}', 'CouponController@update')->middleware('permission:edit_coupon');
//            Route::get('status/{id}/{status}', 'CouponController@status')->name('status')->middleware('permission:edit_coupon');
//            Route::delete('delete/{id}', 'CouponController@delete')->name('delete')->middleware('permission:delete_coupon');
//        });

        Route::group(['prefix' => 'timeSlot', 'as' => 'timeSlot.'], function () {
            Route::get('add-new', 'TimeSlotController@add_new')->name('add-new')->middleware('permission:view_price_group');
            Route::post('store', 'TimeSlotController@store')->name('store')->middleware('permission:add_price_group');
            Route::get('update/{id}', 'TimeSlotController@edit')->name('update')->middleware('permission:edit_price_group');
            Route::post('update/{id}', 'TimeSlotController@update')->middleware('permission:edit_price_group');
            Route::get('status/{id}/{status}', 'TimeSlotController@status')->name('status')->middleware('permission:edit_price_group');
            Route::delete('delete/{id}', 'TimeSlotController@delete')->name('delete')->middleware('permission:delete_price_group');
        });

        Route::group(['prefix' => 'business-settings', 'as' => 'business-settings.'], function () {
            Route::get('ecom-setup', 'BusinessSettingsController@restaurant_index')->name('ecom-setup')->middleware('permission:view_settings');
            Route::post('update-setup', 'BusinessSettingsController@restaurant_setup')->name('update-setup')->middleware('permission:edit_settings');

            Route::get('fcm-index', 'BusinessSettingsController@fcm_index')->name('fcm-index')->middleware('permission:view_settings');
            Route::post('update-fcm', 'BusinessSettingsController@update_fcm')->name('update-fcm')->middleware('permission:edit_settings');

            Route::post('update-fcm-messages', 'BusinessSettingsController@update_fcm_messages')->name('update-fcm-messages')->middleware('permission:edit_settings');

            Route::get('mail-config', 'BusinessSettingsController@mail_index')->name('mail-config')->middleware('permission:view_settings');
            Route::post('mail-config', 'BusinessSettingsController@mail_config')->middleware('permission:edit_settings');

            Route::get('payment-method', 'BusinessSettingsController@payment_index')->name('payment-method')->middleware('permission:view_settings');
            Route::post('payment-method-update/{payment_method}', 'BusinessSettingsController@payment_update')->name('payment-method-update')->middleware('permission:edit_settings');

            Route::get('currency-add', 'BusinessSettingsController@currency_index')->name('currency-add')->middleware('permission:view_settings');
            Route::post('currency-add', 'BusinessSettingsController@currency_store')->middleware('permission:edit_settings');
            Route::get('currency-update/{id}', 'BusinessSettingsController@currency_edit')->name('currency-update')->middleware('permission:edit_settings');
            Route::put('currency-update/{id}', 'BusinessSettingsController@currency_update')->middleware('permission:edit_settings');
            Route::delete('currency-delete/{id}', 'BusinessSettingsController@currency_delete')->name('currency-delete')->middleware('permission:delete_settings');

            Route::get('terms-and-conditions', 'BusinessSettingsController@terms_and_conditions')->name('terms-and-conditions');
            Route::post('terms-and-conditions', 'BusinessSettingsController@terms_and_conditions_update');

            Route::get('location-setup', 'LocationSettingsController@location_index')->name('location-setup');
            Route::post('update-location', 'LocationSettingsController@location_setup')->name('update-location');

            Route::get('privacy-policy', 'BusinessSettingsController@privacy_policy')->name('privacy-policy');
            Route::post('privacy-policy', 'BusinessSettingsController@privacy_policy_update');

            Route::get('about-us', 'BusinessSettingsController@about_us')->name('about-us');
            Route::post('about-us', 'BusinessSettingsController@about_us_update');
        });

        Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
            Route::get('order', 'ReportController@order_index')->name('order');
            Route::get('earning', 'ReportController@earning_index')->name('earning');
            Route::post('set-date', 'ReportController@set_date')->name('set-date');
            Route::get('driver-report', 'ReportController@driver_report')->name('driver-report');
            Route::post('driver-filter', 'ReportController@driver_filter')->name('driver_filter');
            Route::get('product-report', 'ReportController@product_report')->name('product-report');
            Route::post('product-report-filter', 'ReportController@product_report_filter')->name('product-report-filter');
            Route::get('export-product-report', 'ReportController@export_product_report')->name('export-product-report');
            Route::get('sale-report', 'ReportController@sale_report')->name('sale-report');
            Route::post('sale-report-filter', 'ReportController@sale_filter')->name('sale-report-filter');
            Route::get('export-sale-report', 'ReportController@export_sale_report')->name('export-sale-report');
        });

        Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::get('list', 'CustomerController@customer_list')->name('list')->middleware('permission:view_customer');
            Route::get('edit/{id}', 'CustomerController@edit')->name('edit')->middleware('permission:edit_customer');
            Route::put('update/{id}', 'CustomerController@update')->name('update')->middleware('permission:edit_customer');
            Route::get('view/{user_id}', 'CustomerController@view')->name('view')->middleware('permission:view_customer');
            Route::post('search', 'CustomerController@search')->name('search')->middleware('permission:view_customer');
            Route::get('second_approve/{id}/{second_approve}', 'CustomerController@second_approve')->name('second_approve')->middleware('permission:second_approve');
        });
        Route::group(['prefix' => 'admins', 'as' => 'admins.'], function () {
            Route::get('list', 'CustomerController@admin_list')->name('list')->middleware('permission:view_customer');
            Route::get('add-new', 'CustomerController@admin_add')->name('add-new')->middleware('permission:view_customer');
        });
    });
});
