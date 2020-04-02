<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_title','product_description','product_price','product_quantity'];

    public function categories()
    {
      return  $this->belongsToMany('App\Category');
    }

    public function images()
    {
      return $this->hasMany('App\Image','product_id');
    }
}
