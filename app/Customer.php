<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'mobile_number','email','password','address','city','pincode','referred_by','status','created_at','updated_at','deleted_at'
      ];

    protected $appends = ['registered', 'rewards'];

    public function referredBy()
    {
        return $this->hasMany(Customer::class, 'referred_by', 'id');
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referred_id', 'id');
    }
    public function getRegisteredAttribute()
    {
        return $this->referredBy()->count();
    }

    public function getRewardsAttribute()
    {
        return $this->referrals()->sum('points');
    }


}
