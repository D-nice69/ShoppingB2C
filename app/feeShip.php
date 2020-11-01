<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feeShip extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'feeships';
    public function city()
    {
        return $this ->belongsTo(City::class,'matp');
    }
    public function district()
    {
        return $this ->belongsTo(District::class,'maqh');
    }
    public function town()
    {
        return $this ->belongsTo(Town::class,'xaid');
    }
}
