<?php
namespace App\Components;
use App\Category;
class BreadcrumbRecusive{
    function breadCrumb($id) {
        $s = Category::where('id',$id)->first(); 
        $string = "/category/$s->slug";
        if($s->parent_id == 0) {
            return '<li class="breadcrumb-item"><a href='.$string.'>'.$s->category_name.'</a></li>';
        } else {
            return $this->breadCrumb($s->parent_id).'<li class="breadcrumb-item"><a href='.$string.'>'.$s->category_name.'</a></li>';
        }
    }
}