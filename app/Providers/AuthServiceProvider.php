<?php

namespace App\Providers;

use App\Customer;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //compose all the views....
        // view()->composer('*', function ($view){
        //     $c = Session::get('customerId');
        //     $customer = Customer::where('id',$c);
        //     //...with this variable
        //     $view->with('customer', $customer );
        // });
        
        //Category Gate
        Gate::define('list_category','App\Policies\CategoryPolicy@view');
        Gate::define('add_category','App\Policies\CategoryPolicy@create');
        Gate::define('edit_category','App\Policies\CategoryPolicy@update');
        Gate::define('delete_category','App\Policies\CategoryPolicy@delete');

        //Brand Gate
        Gate::define('list_brand','App\Policies\BrandPolicy@view');
        Gate::define('add_brand','App\Policies\BrandPolicy@create');
        Gate::define('edit_brand','App\Policies\BrandPolicy@update');
        Gate::define('delete_brand','App\Policies\BrandPolicy@delete');

        //Product Gate
        Gate::define('list_product','App\Policies\ProductPolicy@view');
        Gate::define('add_product','App\Policies\ProductPolicy@create');
        Gate::define('edit_product','App\Policies\ProductPolicy@update');
        Gate::define('delete_product','App\Policies\ProductPolicy@delete');

        //Slider Gate
        Gate::define('list_slider','App\Policies\SliderPolicy@view');
        Gate::define('add_slider','App\Policies\SliderPolicy@create');
        Gate::define('edit_slider','App\Policies\SliderPolicy@update');
        Gate::define('delete_slider','App\Policies\SliderPolicy@delete');

        //Shipping Gate
        Gate::define('list_shipping','App\Policies\ShippingPolicy@view');
        Gate::define('add_shipping','App\Policies\ShippingPolicy@create');
        Gate::define('edit_shipping','App\Policies\ShippingPolicy@update');
        Gate::define('delete_shipping','App\Policies\ShippingPolicy@delete');

        //Coupon Gate
        Gate::define('list_coupon','App\Policies\CouponPolicy@view');
        Gate::define('add_coupon','App\Policies\CouponPolicy@create');
        Gate::define('delete_coupon','App\Policies\CouponPolicy@delete');
         
        //Order Gate
        Gate::define('show_order','App\Policies\OrderPolicy@view');
        Gate::define('print_order','App\Policies\OrderPolicy@print');
        Gate::define('update_order','App\Policies\OrderPolicy@update');
        Gate::define('delete_order','App\Policies\OrderPolicy@delete');

        //CustomerPermission Gate
        Gate::define('list_user','App\Policies\CustomerPermissionPolicy@view');
        Gate::define('edit_user','App\Policies\CustomerPermissionPolicy@update');
        Gate::define('delete_user','App\Policies\CustomerPermissionPolicy@delete');

        //Role Gate
        Gate::define('list_role','App\Policies\RolePolicy@view');
        Gate::define('add_role','App\Policies\RolePolicy@create');
        Gate::define('edit_role','App\Policies\RolePolicy@update');
        Gate::define('delete_role','App\Policies\RolePolicy@delete');

        //Role Gate
        Gate::define('list_categoryPost','App\Policies\CategoryPostPolicy@view');
        Gate::define('add_categoryPost','App\Policies\CategoryPostPolicy@create');
        Gate::define('edit_categoryPost','App\Policies\CategoryPostPolicy@update');
        Gate::define('delete_categoryPost','App\Policies\CategoryPostPolicy@delete');

        //Role Gate
        Gate::define('list_post','App\Policies\PostPolicy@view');
        Gate::define('add_post','App\Policies\PostPolicy@create');
        Gate::define('edit_post','App\Policies\PostPolicy@update');
        Gate::define('delete_post','App\Policies\PostPolicy@delete');
    }
}
