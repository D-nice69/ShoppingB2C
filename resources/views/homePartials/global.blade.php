<?php
use App\Category;
 $categories = Category::where('category_status',0)->where('parent_id',0)->latest()->get();
?>