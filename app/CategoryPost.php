<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    protected $guarded = [];
    public function categoryPostChildrent()
    {
        return $this->hasMany(CategoryPost::class,'parent_id');
    }
}
