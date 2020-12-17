<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\CategoryPost;
use App\Comment;
use App\Customer;
use App\Post;
use App\Product;
use App\Slider;
use App\Tag;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;
use App\Components\BreadcrumbRecusive;
use App\Rating;
use Illuminate\Support\Facades\Auth;
use App\Components\filter;
use App\Picture;
use App\Seller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $meta_desc = "";
        $meta_keywords = "";
        $meta_title = "";
        $url_canonical = $request->url();
        $products = Product::where('product_status',0)->latest()->paginate(9);
        toastr()->info('Info Message');
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
        $filter = new filter();
        $productC = $filter->sort('category_id',$getCategory->id);
        $min = $filter->min('category_id',$getCategory->id);
        $max = $filter->max('category_id',$getCategory->id);
        return view('home.categoryProduct.index',compact('min','max','meta_desc','meta_keywords','meta_title','url_canonical','getCategory','productC'));
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
        $filter = new filter();
        $productB = $filter->sort('brand_id',$getBrand->id);
        $min = $filter->min('brand_id',$getBrand->id);
        $max = $filter->max('brand_id',$getBrand->id);

        return view('home.brandProduct.index',compact('productB','max','min','meta_desc','meta_keywords','meta_title','url_canonical','getBrand'));
    }
    public function tagProduct($slug, Request $request)
    {
        $getTag = Tag::where('slug',$slug)->first();
        //SEO
        $meta_desc = $getTag->name;
        $meta_keywords = $getTag->name;
        $meta_title = $getTag->name;
        $url_canonical = $request->url();
        //--SEO
        $tagProducts = Tag::find($getTag->id)->products;
        return view('home.tagProduct.index',compact('meta_desc','meta_keywords','meta_title','url_canonical','tagProducts','getTag'));
    }
    public function productDetails($slug, $id, Request $request)
    {
        
        $getProduct = Product::where('slug',$slug)->where('id',$id)->first();
        $bread = new BreadcrumbRecusive();
        $productCategory = Category::where('id',$getProduct->category_id)->first();
        $id = $productCategory->id;
        $html = $bread->breadCrumb($id);
        //SEO
        $meta_desc = $getProduct->product_desc;
        $meta_keywords = $getProduct->keyword;
        $meta_title = $getProduct->product_name;
        $url_canonical = $request->url();
        //--SEO
        $rating = Rating::where('product_id',$getProduct->id)->avg('rating');
        $rating = round($rating);
        $ratings = Rating::where('product_id',$getProduct->id)->get();
        $productCategories = Product::where('category_id',$getProduct->category_id)->whereNotIn('products.id',[$getProduct->id])->take(6)->get();
        return view('home.Product.product_detail',compact('ratings','rating','html','meta_desc','meta_keywords','meta_title','url_canonical','getProduct','productCategories'));
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
        $searchProducts = Product::where('product_name','LIKE','%'.$keyword.'%')->get();
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
    public function AutocompleteSearch(Request $request)
    {
        $data = $request->all();
        if($data['query']){
            $product = Product::where('product_status',0)->where('product_name','LIKE','%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block;
            margin-left: 10px;">';
            foreach($product as $val){
                $output .= '<li class="li_search_ajax"><a id="aAuto">'.$val->product_name.'</a></li>';
            }
            $output .='</ul>';
            echo $output;
        }
    }
    public function rating(Request $request)
    {
        $data = $request->all();
        if(Auth::user()){
            $storeRating = Rating::updateOrCreate([
                'product_id' => $data['product_id'],
                'user_id' => $data['user_id'],
            ],
            [
                'rating' =>$data['index'],
            ]
        );
            echo 'done';
        }else{
            echo 'login';
        }
    }
    public function shop($id, Request $request)
    {
        //SEO
        $meta_desc = "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--SEO
        $i = $id;
        $seller = Seller::where('customer_id',$id)->first();
        $pic = Picture::where('customer_id',$id)->first();
        $products = Product::where('user_id',$id)->get();
        return view('home.shop.index',compact('meta_desc','meta_keywords','meta_title','url_canonical','pic','seller','products','i'));
    }

    
   
}
