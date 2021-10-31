<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable =[
        'name', 'mobile_number', 'customer_id', 'user_id' ,'created_at','updated_at','deleted_at'
    ];

    protected $appends = ['customer_name', 'user_name'];

    public function getUserNameAttribute()
    {
        return !is_null($this->user_id)?$this->user->name:'';
    }

    public function getCustomerNameAttribute()
    {
        return !is_null($this->customer_id)?$this->customer->name:'';
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
