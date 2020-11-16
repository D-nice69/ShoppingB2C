<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\CategoryPost;
use App\Comment;
use App\Post;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $meta_desc = "";
        $meta_keywords = "";
        $meta_title = "";
        $url_canonical = $request->url();
        $products = Product::where('product_status',0)->latest()->get();
        return view('eshopHome',compact('products','meta_desc','meta_keywords','meta_title','url_canonical'));
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
        return view('home.categoryProduct.index',compact('meta_desc','meta_keywords','meta_title','url_canonical','categoryProducts','getCategory'));
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
        return view('home.brandProduct.index',compact('meta_desc','meta_keywords','meta_title','url_canonical','brandProducts','getBrand'));
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
        return view('home.Product.product_detail',compact('meta_desc','meta_keywords','meta_title','url_canonical','getProduct','productCategories'));
    }
    public function search(Request $request)
    {
        //SEO
        $meta_desc = "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--SEO
        $products = Product::latest()->get();
        $keyword = $request->keywords_submit;
        $searchProducts = Product::where('product_name','like','%'.$keyword.'%')->get();
        return view('home.Product.search',compact('products','meta_desc','meta_keywords','meta_title','url_canonical','searchProducts'));
    }
    public function new(Request $request)
    {
        //SEO
        $meta_desc = "Tin tức";
        $meta_keywords = "Tin tức";
        $meta_title = "Tin tức";
        $url_canonical = $request->url();
        //--SEO
        $news = Post::latest()->paginate(4);
        return view('home.news.index',compact('meta_desc','meta_keywords','meta_title','url_canonical','news'));
    }
    public function newDetails($slug, Request $request)
    {
        //SEO
        $meta_desc = "Tin tức";
        $meta_keywords = "Tin tức";
        $meta_title = "Tin tức";
        $url_canonical = $request->url();
        //--SEO
        $new = Post::where('slug',$slug)->where('status',0)->first();
        $news = Post::where('category_post_id',$new->category_post_id)->where('status',0)->take(6)->where('id','!=',$new->id)->get();
        return view('home.news.newDetails',compact('new','news','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function newCategory($slug, Request $request)
    {
        //SEO
        $meta_desc = "Tin tức";
        $meta_keywords = "Tin tức";
        $meta_title = "Tin tức";
        $url_canonical = $request->url();
        //--SEO
        $category = CategoryPost::where('slug',$slug)->where('status',0)->first();
        $categoryPosts = Post::where('category_post_id',$category->id)->where('status',0)->paginate(4);
        return view('home.news.categoryNew',compact('category','categoryPosts','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
}
