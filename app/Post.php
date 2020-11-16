<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    public function category_post()
    {
        return $this->belongsTo(CategoryPost::class,'category_post_id');
    }
}
