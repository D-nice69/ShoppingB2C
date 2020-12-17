<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    protected $guarded = [];
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function checkPermissionAccess($permissionCheck)
    {
        $role = Role::where('id',auth()->user()->role_id)->first();
        $permission = $role->permissions;
        if($permission->contains('key_code',$permissionCheck)){
            return true;
        }
        return false;
    }
    public function seller()
    {
        return $this->hasOne(Seller::class,'customer_id');
    }
}
