<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'name','type','matp'
    ];
    protected $primaryKey = 'maqh';
    protected $table = 'devvn_quanhuyen';
}
