<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
   protected $fillable = ['order_id','user_id','product_id','price','quantity'];
}
