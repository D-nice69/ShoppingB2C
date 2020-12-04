<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $guarded = [];
    public function category()
    {
        return $this ->belongsTo(Category::class,'category_id');
    }
    public function brand()
    {
        return $this ->belongsTo(Brand::class,'brand_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }
    public function tags()
    {
        return $this
            ->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')
            ->withTimestamps();
    }
    public function customer()
    {
        return $this ->belongsTo(Customer::class,'user_id');
    }
}
