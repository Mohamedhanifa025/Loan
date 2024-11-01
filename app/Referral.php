<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable =[
        'apply_loan_id', 'customer_id','referred_id','points','status','created_at','updated_at','deleted_at'
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
