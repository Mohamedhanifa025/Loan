<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable =[
        'customer_id', 'mobile_number','created_at','updated_at','deleted_at'
    ];
}
