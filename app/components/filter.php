<?php
namespace App\Components;
use App\Product;
class filter{
    function sort ($table, $id){
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='price_up'){
                $productC = Product::where($table,$id)->orderBy('product_price','ASC')->paginate(9)->appends(request()->query());
            }elseif($sort_by=='price_down'){
                $productC = Product::where($table,$id)->orderBy('product_price','DESC')->paginate(9)->appends(request()->query());
            }elseif($sort_by=='name_az'){
                $productC = Product::where($table,$id)->orderBy('product_name','ASC')->paginate(9)->appends(request()->query());
            }elseif($sort_by=='name_za'){
                $productC = Product::where($table,$id)->orderBy('product_name','DESC')->paginate(9)->appends(request()->query());
            }           
        }elseif(isset($_GET['start_price']) && isset($_GET['end_price'])){
            $start_price = $_GET['start_price'];
            $end_price = $_GET['end_price'];
            $productC = Product::where($table,$id)->whereBetween('product_price',[$start_price,$end_price])->latest()->paginate(9)->appends(request()->query());
        }else{
            $productC = Product::where($table,$id)->latest()->paginate(9);
        }      
        return $productC;     
    }
    function min($table, $id){
        $min = Product::where($table,$id)->min('product_price');
        return $min;
    }
    function max($table, $id){
        $max = Product::where($table,$id)->max('product_price');
        return $max;
    }
}
