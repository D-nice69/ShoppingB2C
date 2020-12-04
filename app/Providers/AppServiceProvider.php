<?php

namespace App\Providers;

use App\Admin;
use App\Brand;
use App\Category;
use App\Customer;
use App\Slider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        view()->composer('adminPartials.header',function ($view){
            $view->with('admin',Admin::all()->first());
        });

        //left_sidebar
        view()->composer('homePartials.left_sidebar',function ($view){
            $view->with('categories', Category::where('category_status',0)->where('parent_id',0)->latest()->get());
        });
        view()->composer('homePartials.left_sidebar',function ($view){
            $view->with('brands',Brand::where('brand_status',0)->latest()->get());
        });

        //slider
        view()->composer('homePartials.slider',function ($view){
            $view->with('sliders',Slider::where('status',0)->latest()->limit(5)->get());
        });
       
    }
}
