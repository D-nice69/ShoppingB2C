<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'permission_roles','role_id','permission_id');
    }
}
