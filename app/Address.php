<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id','first_name','last_name','address','zip_code','mobile_number','landmark'];
}
