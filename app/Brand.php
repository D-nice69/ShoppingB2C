<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];
    public function products()
    {
        return $this ->hasMany(Product::class,'brand_id');
    }
}
