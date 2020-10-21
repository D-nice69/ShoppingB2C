<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function customer()
    {
        return $this ->belongsTo(Customer::class,'customer_id');
    }
    public function shipping()
    {
        return $this ->belongsTo(Shipping::class,'shipping_id');
    }
    public function orderDetails()
    {
        return $this ->hasMany(Order_detail::class,'order_id');
    }
}
