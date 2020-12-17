<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $guarded = [];
 	public function login(){
 		return $this->belongsTo(Customer::class,'user');
 	}

}
