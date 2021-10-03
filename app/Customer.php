<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'mobile_number','email','password','address','city','pincode','referred_by','status','created_at','updated_at','deleted_at'
      ];
}
