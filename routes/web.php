<?php

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



Auth::routes();

//Backend Route
Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@index')->name('Admin.index');
    Route::get('/dashboard', 'AdminController@showDashboard')->name('Admin.showDashboard');
    Route::post('/admin-login', 'AdminController@adminLogin')->name('Admin.adminLogin');
    Route::get('/logout','AdminController@logout')->name('Admin.logout');


    Route::prefix('categories')->group(function () {
        Route::get('/', 'categoryController@index')
            ->name('category.index');
        Route::get('/create', 'categoryController@create')
            ->name('category.create');
        Route::post('/store', 'categoryController@store')
            ->name('category.store');
        Route::get('/edit/{id}', 'categoryController@edit')
            ->name('category.edit');
        Route::post('/update/{id}', 'categoryController@update')
            ->name('category.update');
        Route::get('/active/{id}', 'categoryController@active')
        ->name('category.active');
        Route::get('/unactive/{id}', 'categoryController@unactive')
        ->name('category.unactive');
        Route::get('/delete/{id}', 'categoryController@delete')
            ->name('category.delete');
    });
    Route::prefix('brands')->group(function () {
        Route::get('/', 'brandController@index')
            ->name('brand.index');
        Route::get('/create', 'brandController@create')
            ->name('brand.create');
        Route::post('/store', 'brandController@store')
            ->name('brand.store');
        Route::get('/edit/{id}', 'brandController@edit')
            ->name('brand.edit');
        Route::post('/update/{id}', 'brandController@update')
            ->name('brand.update');
        Route::get('/delete/{id}', 'brandController@delete')
            ->name('brand.delete');
        Route::get('/unactive/{id}', 'brandController@unactive')
            ->name('brand.unactive');
        Route::get('/active/{id}', 'brandController@active')
            ->name('brand.active');
    });
    Route::prefix('products')->group(function () {
        Route::get('/', 'productController@index')
            ->name('product.index');
        Route::get('/create', 'productController@create')
            ->name('product.create');
        Route::post('/store', 'productController@store')
            ->name('product.store');
        Route::get('/edit/{id}', 'productController@edit')
            ->name('product.edit');
        Route::post('/update/{id}', 'productController@update')
            ->name('product.update');
        Route::get('/delete/{id}', 'productController@delete')
            ->name('product.delete');
        Route::get('/unactive/{id}', 'productController@unactive')
            ->name('product.unactive');
        Route::get('/active/{id}', 'productController@active')
            ->name('product.active');
    });
    Route::prefix('orders')->group(function () {
        Route::get('/', 'orderController@index')->name('order.index');
        Route::get('/view/{id}', 'orderController@view')->name('order.view');
        Route::get('/print/{checkout_code}', 'orderController@print')->name('order.print');
        Route::get('/delete/{id}', 'orderController@delete')->name('order.delete');
        Route::get('/update/{id}', 'orderController@update')->name('order.update');

    });
    Route::prefix('coupons')->group(function () {
        Route::get('/', 'couponController@index')
            ->name('coupon.index');
        Route::get('/create', 'couponController@create')
            ->name('coupon.create');
        Route::post('/store', 'couponController@store')
            ->name('coupon.store');   
        Route::get('/delete/{id}', 'couponController@delete')
            ->name('coupon.delete');    
       
    });
    Route::prefix('deliveries')->group(function () {
        Route::get('/', 'deliveryController@index')->name('delivery.index');
        Route::post('/select-delivery', 'deliveryController@select')->name('delivery.select');
        Route::post('/store', 'deliveryController@store')->name('delivery.store');
        Route::post('/update', 'deliveryController@update')->name('delivery.update');
        // Route::get('/create', 'deliveryController@create')->name('delivery.create');
        // Route::get('/edit/{id}', 'deliveryController@edit')->name('delivery.edit');
        // Route::get('/delete/{id}', 'deliveryController@delete')->name('delivery.delete');
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', 'sliderController@index')->name('slider.index');
        Route::get('/create', 'sliderController@create')->name('slider.create');
        Route::post('/store', 'sliderController@store')->name('slider.store');
        Route::get('/unactive/{id}', 'sliderController@unactive')->name('slider.unactive');
        Route::get('/active/{id}', 'sliderController@active')->name('slider.active');
        Route::get('/edit/{id}', 'sliderController@edit')->name('slider.edit');
        Route::post('/update/{id}', 'sliderController@update')->name('slider.update');
        Route::get('/delete/{id}', 'sliderController@delete')->name('slider.delete');
    });
    


    // Route::prefix('settings')->middleware('auth')->group(function () {
    //     Route::get('/', 'settingController@index')->name('setting.index');
    //     Route::get('/create', 'settingController@create')->name('setting.create');
    //     Route::post('/store', 'settingController@store')->name('setting.store');
    //     Route::get('/edit/{id}', 'settingController@edit')->name('setting.edit');
    //     Route::post('/update/{id}', 'settingController@update')->name('setting.update');
    //     Route::get('/delete/{id}', 'settingController@delete')->name('setting.delete');
    // });

    // Route::prefix('users')
    //     // ->middleware('auth')
    //     ->group(function () {
    //         Route::get('/', 'adminUserController@index')->name('users.index');
    //         Route::get('/create', 'adminUserController@create')->name('users.create');
    //         Route::post('/store', 'adminUserController@store')->name('users.store');
    //         Route::get('/edit/{id}', 'adminUserController@edit')->name('users.edit');
    //         Route::post('/update/{id}', 'adminUserController@update')->name('users.update');
    //         Route::get('/delete/{id}', 'adminUserController@delete')->name('users.delete');
    //     }
    // );

    // Route::prefix('roles')
    //     // ->middleware('auth')
    //     ->group(function () {
    //         Route::get('/', 'AdminRoleController@index')->name('role.index');
    //         Route::get('/create', 'AdminRoleController@create')->name('role.create');
    //         Route::post('/store', 'AdminRoleController@store')->name('role.store');
    //         Route::get('/edit/{id}', 'AdminRoleController@edit')->name('role.edit');
    //         Route::post('/update/{id}', 'AdminRoleController@update')->name('role.update');
    //         Route::get('/delete/{id}', 'AdminRoleController@delete')->name('role.delete');
    //     }
    // );

    // Route::prefix('permissions')
    //     // ->middleware('auth')
    //     ->group(function () {
    //         Route::get('/', 'AdminPermissionController@index')->name('permission.index');
    //         Route::get('/create', 'AdminPermissionController@create')->name('permission.create');
    //         Route::post('/store', 'AdminPermissionController@store')->name('permission.store');
    //         // Route::get('/edit/{id}', 'AdminPermissionController@edit')->name('permission.edit');
    //         // Route::post('/update/{id}', 'AdminPermissionController@update')->name('permission.update');
    //         // Route::get('/delete/{id}', 'AdminPermissionController@delete')->name('permission.delete');
    //     }
    // );
});

//Fontend Route

//Home
Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@index')->name('home');

//get products by category
Route::get('/category/{slug}','HomeController@categoryProduct')->name('home.categoryProduct');

//get products by brand
Route::get('/brand/{slug}','HomeController@brandProduct')->name('home.brandProduct');

//product details
Route::get('/product-details/{slug}','HomeController@productDetails')->name('home.productDetails');

//Shopping cart
Route::get('/cart','CartController@index')->name('cart.index');
Route::post('/store-cart','CartController@store')->name('cart.store');
Route::get('/delete-cart/{id}','CartController@delete')->name('cart.delete');
Route::post('/update-cart','CartController@update')->name('cart.update');
//Shopping cart Ajax
Route::get('/show-cart','CartController@show')->name('cart.show');
Route::post('/add-cart-ajax','CartController@addCartAjax')->name('cart.addCartAjax');
Route::get('/delete-cart-ajax/{id}','CartController@deleteAjax')->name('cart.deleteAjax');
Route::post('/update-cart-ajax/{id}','CartController@updateAjax')->name('cart.updateAjax');

//Customer checkout
Route::get('/login','CustomerController@login')->name('customer.login');
Route::post('/login-customer','CustomerController@loginCustomer')->name('customer.loginCustomer');
Route::get('/register', 'CustomerController@register')->name('customer.register');
Route::get('/checkout', 'CustomerController@checkout')->name('customer.checkout');
Route::post('/add-customer', 'CustomerController@add')->name('customer.add');
Route::post('/save-checkout', 'CustomerController@saveCheckout')->name('customer.saveCheckout');
Route::get('/payment', 'CustomerController@payment')->name('customer.payment');
Route::get('/logout','CustomerController@logout')->name('customer.logout');
Route::post('/calculate-delivery','CustomerController@deliveryCal')->name('customer.deliveryCal');
Route::get('/delete-delivery','CustomerController@deliveryDel')->name('customer.deliveryDel');

//Search Product
Route::post('/search', 'HomeController@search')->name('home.search');

//Order
Route::post('/order-place', 'OrderController@orderPlace')->name('order.orderPlace');
Route::post('/order-confirm', 'OrderController@confirm')->name('order.confirm');

//Send mail
Route::get('/send-mail', 'MailController@send_mail')->name('mail.send_mail');

//Login facebook
Route::get('/login-facebook','AdminController@login_facebook')->name('loginFacebook');
Route::get('/admin/callback','AdminController@callback_facebook');

//Login  google
Route::get('/login-google','AdminController@login_google')->name('loginGoogle');
Route::get('/google/callback','AdminController@callback_google');

//Coupon
Route::post('/check-coupon', 'CouponController@checkCoupon')->name('coupon.checkCoupon');
Route::get('/unset-coupon', 'CouponController@unset')->name('coupon.unset');

//thanks for shopping
Route::get('/thanks', 'CustomerController@thanks')->name('customer.thanks');
