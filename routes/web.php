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

//--------------------------------------------------------Backend Route

Route::get('admin/shops/index', 'ShopController@index')->name('shop.index');
Route::get('admin/shops/store', 'ShopController@store');
Route::post('admin/shops/store', 'ShopController@store')->name('shop.store');
Route::post('crop-image-upload ', 'ShopController@uploadCropImage')->name('crop');
Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@index')->name('Admin.index');
    Route::get('/dashboard', 'AdminController@showDashboard')->name('Admin.showDashboard');
    Route::post('/admin-login', 'AdminController@adminLogin')->name('Admin.adminLogin');
    Route::get('/logout','AdminController@logout')->name('Admin.logout');


    Route::prefix('categories')->group(function () {
        Route::get('/', 'categoryController@index')
            ->middleware('can:list_category')
            ->name('category.index');
        Route::get('/create', 'categoryController@create')
            ->middleware('can:add_category')
            ->name('category.create');
        Route::post('/store', 'categoryController@store')
            ->name('category.store');
        Route::get('/edit/{id}', 'categoryController@edit')
            ->middleware('can:edit_category')
            ->name('category.edit');
        Route::post('/update/{id}', 'categoryController@update')
            ->name('category.update');
        Route::get('/active/{id}', 'categoryController@active')
        ->name('category.active');
        Route::get('/unactive/{id}', 'categoryController@unactive')
        ->name('category.unactive');
        Route::get('/delete/{id}', 'categoryController@delete')
            ->middleware('can:delete_category')
            ->name('category.delete');
    });
    Route::prefix('brands')->group(function () {
        Route::get('/', 'brandController@index')
            ->middleware('can:list_brand')
            ->name('brand.index');
        Route::get('/create', 'brandController@create')
            ->middleware('can:add_brand')
            ->name('brand.create');
        Route::post('/store', 'brandController@store')
            ->name('brand.store');
        Route::get('/edit/{id}', 'brandController@edit')
            ->middleware('can:edit_brand')
            ->name('brand.edit');
        Route::post('/update/{id}', 'brandController@update')
            ->name('brand.update');
        Route::get('/delete/{id}', 'brandController@delete')
            ->middleware('can:delete_brand')
            ->name('brand.delete');
        Route::get('/unactive/{id}', 'brandController@unactive')
            ->name('brand.unactive');
        Route::get('/active/{id}', 'brandController@active')
            ->name('brand.active');
    });
    Route::prefix('products')->group(function () {
        Route::get('/', 'productController@index')
            ->middleware('can:list_product')
            ->name('product.index');
        Route::get('/create', 'productController@create')
            ->middleware('can:add_product')
            ->name('product.create');
        Route::post('/store', 'productController@store')
            ->name('product.store');
        Route::get('/edit/{id}', 'productController@edit')
            ->middleware('can:edit_product')
            ->name('product.edit');
        Route::post('/update/{id}', 'productController@update')
            ->name('product.update');
        Route::get('/delete/{id}', 'productController@delete')
            ->middleware('can:delete_product')
            ->name('product.delete');
        Route::get('/unactive/{id}', 'productController@unactive')
            ->name('product.unactive');
        Route::get('/active/{id}', 'productController@active')
            ->name('product.active');       
    });
    Route::prefix('orders')->group(function () {
        Route::get('/', 'orderController@index')
            ->middleware('can:show_order')
            ->name('order.index');
        Route::get('/view/{id}', 'orderController@view')
            ->name('order.view');
        Route::get('/print/{checkout_code}', 'orderController@print')
            ->middleware('can:print_order')
            ->name('order.print');
        Route::get('/update/{id}', 'orderController@update')
            ->middleware('can:update_order')
            ->name('order.update');
        Route::get('/delete/{id}', 'orderController@delete')
            ->middleware('can:delete_order')
            ->name('order.delete');

    });
    Route::prefix('coupons')->group(function () {
        Route::get('/', 'couponController@index')
            ->middleware('can:list_coupon')
            ->name('coupon.index');
        Route::get('/create', 'couponController@create')
            ->middleware('can:add_coupon')
            ->name('coupon.create');
        Route::get('/edit/{id}', 'couponController@edit')
            // ->middleware('can:add_coupon')
            ->name('coupon.edit');
        Route::post('/store', 'couponController@store')
            ->name('coupon.store'); 
        Route::post('/update/{id}', 'couponController@update')
            ->name('coupon.update');     
        Route::get('/delete/{id}', 'couponController@delete')
            ->middleware('can:delete_coupon')
            ->name('coupon.delete');    
       
    });
    Route::prefix('deliveries')->group(function () {
        Route::get('/', 'deliveryController@index')
            ->middleware('can:list_shipping')
            ->name('delivery.index');
        Route::post('/select-delivery', 'deliveryController@select')->name('delivery.select');
        Route::post('/store', 'deliveryController@store')->name('delivery.store');
        Route::post('/update', 'deliveryController@update')->name('delivery.update');
        // Route::get('/create', 'deliveryController@create')->name('delivery.create');
        // Route::get('/edit/{id}', 'deliveryController@edit')->name('delivery.edit');
        // Route::get('/delete/{id}', 'deliveryController@delete')->name('delivery.delete');
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', 'sliderController@index')
            ->middleware('can:list_slider')
            ->name('slider.index');
        Route::get('/create', 'sliderController@create')
            ->middleware('can:add_slider')
            ->name('slider.create');
        Route::post('/store', 'sliderController@store')
            ->name('slider.store');
        Route::get('/unactive/{id}', 'sliderController@unactive')
            ->name('slider.unactive');
        Route::get('/active/{id}', 'sliderController@active')
            ->name('slider.active');
        Route::get('/edit/{id}', 'sliderController@edit')
            ->middleware('can:edit_slider')
            ->name('slider.edit');
        Route::post('/update/{id}', 'sliderController@update')
            ->name('slider.update');
        Route::get('/delete/{id}', 'sliderController@delete')
            ->middleware('can:delete_slider')
            ->name('slider.delete');
    });

    Route::prefix('category-posts')
        ->group(function () {
            Route::get('/', 'CategoryPostController@index')
                // ->middleware('can:list_user')
                ->name('categoryPost.index');
            Route::get('/create', 'CategoryPostController@create')
                // ->middleware('can:add_slider')
                ->name('categoryPost.create');
            Route::post('/store', 'CategoryPostController@store')
                ->name('categoryPost.store');
            Route::get('/unactive/{id}', 'CategoryPostController@unactive')
                ->name('categoryPost.unactive');
            Route::get('/active/{id}', 'CategoryPostController@active')
                ->name('categoryPost.active');
            Route::get('/edit/{id}', 'CategoryPostController@edit')
                // ->middleware('can:edit_user')
                ->name('categoryPost.edit');
            Route::post('/update/{id}', 'CategoryPostController@update')
                ->name('categoryPost.update');
            Route::get('/delete/{id}', 'CategoryPostController@delete')
                // ->middleware('can:delete_user')
                ->name('categoryPost.delete');
        }
    );

    Route::prefix('posts')
        ->group(function () {
            Route::get('/', 'PostController@index')
                // ->middleware('can:list_user')
                ->name('post.index');
            Route::get('/create', 'PostController@create')
                // ->middleware('can:add_slider')
                ->name('post.create');
            Route::post('/store', 'PostController@store')
                ->name('post.store');
            Route::get('/unactive/{id}', 'PostController@unactive')
                ->name('post.unactive');
            Route::get('/active/{id}', 'PostController@active')
                ->name('post.active');
            Route::get('/edit/{id}', 'PostController@edit')
                // ->middleware('can:edit_user')
                ->name('post.edit');
            Route::post('/update/{id}', 'PostController@update')
                ->name('post.update');
            Route::get('/delete/{id}', 'PostController@delete')
                // ->middleware('can:delete_user')
                ->name('post.delete');
        }
    );
    
    Route::prefix('customers')
        ->group(function () {
            Route::get('/', 'AdminCustomerController@index')
                ->middleware('can:list_user')
                ->name('adminCustomer.index');
            // Route::post('/store', 'AdminCustomerController@store')->name('adminCustomer.store');
            Route::get('/edit/{id}', 'AdminCustomerController@edit')
                ->middleware('can:edit_user')
                ->name('adminCustomer.edit');
            Route::post('/update/{id}', 'AdminCustomerController@update')
                ->name('adminCustomer.update');
            Route::get('/delete/{id}', 'AdminCustomerController@delete')
                ->middleware('can:delete_user')
                ->name('adminCustomer.delete');
        }
    );
    

    // Route::prefix('settings')->middleware('auth')->group(function () {
    //     Route::get('/', 'settingController@index')->name('setting.index');
    //     Route::get('/create', 'settingController@create')->name('setting.create');
    //     Route::post('/store', 'settingController@store')->name('setting.store');
    //     Route::get('/edit/{id}', 'settingController@edit')->name('setting.edit');
    //     Route::post('/update/{id}', 'settingController@update')->name('setting.update');
    //     Route::get('/delete/{id}', 'settingController@delete')->name('setting.delete');
    // });
    Route::prefix('roles')
        ->group(function () {
            Route::get('/', 'RoleController@index')
                ->middleware('can:list_role')
                ->name('role.index');
            Route::get('/create', 'RoleController@create')
                ->middleware('can:add_role')
                ->name('role.create');
            Route::post('/store', 'RoleController@store')
               ->name('role.store');
            Route::get('/edit/{id}', 'RoleController@edit')
                ->middleware('can:edit_role')
                ->name('role.edit');
            Route::post('/update/{id}', 'RoleController@update')
                ->name('role.update');
            Route::get('/delete/{id}', 'RoleController@delete')
                ->middleware('can:delete_role')
                ->name('role.delete');
        }
    );

    // Route::prefix('shops')
    //     ->group(function () {
    //         Route::get('/', 'ShopController@index')
    //             // ->middleware('can:list_shop')
    //             ->name('shop.index');
    //         // Route::get('/create', 'ShopController@create')
    //         //     // ->middleware('can:add_shop')
    //         //     ->name('shop.create');
    //         Route::post('/store', 'ShopController@store')
    //            ->name('shop.store');
    //         Route::post('/cropImage', 'ShopController@cropImage')
    //             ->name('shop.cropImage');
    //         Route::get('/cropImage', 'ShopController@index2')
    //             ->name('shop.index2');
    //         // Route::get('/edit/{id}', 'ShopController@edit')
    //         //     // ->middleware('can:edit_shop')
    //         //     ->name('shop.edit');
    //         // Route::post('/update/{id}', 'ShopController@update')
    //         //     ->name('shop.update');
    //         // Route::get('/delete/{id}', 'ShopController@delete')
    //         //     // ->middleware('can:delete_shop')
    //         //     ->name('shop.delete');
    //     }
    // );
});

//---------------------------Fontend Route

//Home
Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@index')->name('home');

//news
Route::get('/news', 'HomeController@new')->name('home.new');
Route::get('/news/{slug}', 'HomeController@newDetails')->name('home.newDetails');
Route::get('/news/category/{slug}', 'HomeController@newCategory')->name('home.newCategory');

//get products by category
Route::get('/category/{slug}','HomeController@categoryProduct')->name('home.categoryProduct');

//get products by brand
Route::get('/brand/{slug}','HomeController@brandProduct')->name('home.brandProduct');

//get products by tags
Route::get('/tag/{slug}','HomeController@tagProduct')->name('home.tagProduct');

//product details
Route::get('/product-details/{slug}/{id}','HomeController@productDetails')->name('home.productDetails');

//rating
Route::post('/rating','HomeController@rating')->name('home.rating');

//Shopping cart
Route::get('/cart','CartController@index')->name('cart.index');
Route::post('/store-cart','CartController@store')->name('cart.store');
Route::get('/delete-cart/{id}','CartController@delete')->name('cart.delete');
Route::post('/update-cart','CartController@update')->name('cart.update');
//Shopping cart Ajax

Route::get('/show-cart','CartController@show')->name('cart.show');
Route::post('/add-cart-ajax','CartController@addCartAjax')->name('cart.addCartAjax');
Route::post('/add-cart-ajax-detail','CartController@addCartAjaxDetail')->name('cart.addCartAjaxDetail');
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
//Autocomplete search
Route::post('/AutocompleteSearch', 'HomeController@AutocompleteSearch')->name('home.AutocompleteSearch');

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

//shop
Route::get('/shop/{id}', 'HomeController@shop')->name('home.shop');

//forget password
Route::get('/password-forget', 'CustomerController@forgetPassword')->name('Customer.forgetPassword');
Route::post('/password-reset', 'CustomerController@resetPassword')->name('Customer.resetPassword');
//verify account
Route::get('/account-verify', 'CustomerController@accountVerify')->name('Customer.accountVerify');

