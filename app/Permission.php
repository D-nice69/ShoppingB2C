<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];
    public function permissionChild()
    {
        return $this->hasMany(Permission::class,'parent_id');
    }
    
}
