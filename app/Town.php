<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'name','type','maqh'
    ];
    protected $primaryKey = 'xaid';
    protected $table = 'devvn_xaphuongthitran';
}
