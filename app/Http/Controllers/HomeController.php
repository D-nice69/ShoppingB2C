<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Comment;
use App\Product;
use Illuminate\Http\Request;
use Cart;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $meta_desc = "";
        $meta_keywords = "";
        $meta_title = "";
        $url_canonical = $request->url();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::latest()->get();
        return view('eshopHome',compact('categories','brands','products','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function categoryProduct($slug, Request $request)
    {
        $getCategory = Category::where('slug',$slug)->first();
        //SEO
        $meta_desc = $getCategory->category_description;
        $meta_keywords = $getCategory->keyword;
        $meta_title = $getCategory->category_name;
        $url_canonical = $request->url();
        //--SEO
        $categoryProducts = Category::find($getCategory->id)->products;
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('home.categoryProduct.index',compact('categories','brands','meta_desc','meta_keywords','meta_title','url_canonical','categoryProducts','getCategory'));
    }
    public function brandProduct($slug, Request $request)
    {
        $getBrand = Brand::where('slug',$slug)->first();
        //SEO
        $meta_desc = $getBrand->brand_description;
        $meta_keywords = $getBrand->keyword;
        $meta_title = $getBrand->brand_name;
        $url_canonical = $request->url();
        //--SEO
        $brandProducts = Brand::find($getBrand->id)->products;
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('home.brandProduct.index',compact('categories','brands','meta_desc','meta_keywords','meta_title','url_canonical','brandProducts','getBrand'));
    }
    public function productDetails($slug, Request $request)
    {
        $getProduct = Product::where('slug',$slug)->first();
        //SEO
        $meta_desc = $getProduct->product_desc;
        $meta_keywords = $getProduct->keyword;
        $meta_title = $getProduct->product_name;
        $url_canonical = $request->url();
        //--SEO
        $productCategories = Product::where('category_id',$getProduct->category_id)->whereNotIn('products.id',[$getProduct->id])->get();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('home.Product.product_detail',compact('categories','brands','meta_desc','meta_keywords','meta_title','url_canonical','getProduct','productCategories'));
    }
    public function search(Request $request)
    {
        //SEO
        $meta_desc = "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--SEO
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::latest()->get();
        $keyword = $request->keywords_submit;
        $searchProducts = Product::where('product_name','like','%'.$keyword.'%')->get();
        return view('home.Product.search',compact('categories','brands','products','meta_desc','meta_keywords','meta_title','url_canonical','searchProducts'));
    }
}
