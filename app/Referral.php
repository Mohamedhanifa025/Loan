<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable =[
        'customer_id','referred_id','points','status','created_at','updated_at','deleted_at'
    ];
}
