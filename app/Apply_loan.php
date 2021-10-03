<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply_loan extends Model
{
    protected $fillable =[
        'customer_id','company_name','salary','location','message','status','created_at','updated_at','deleted_at'
    ];
}
