<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_title','product_description','product_price'];

    public function categories()
    {
      return  $this->belongsToMany('App\Category');
    }
}
