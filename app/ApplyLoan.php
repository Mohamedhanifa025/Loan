<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplyLoan extends Model
{
    protected $fillable =[
        'customer_id', 'name', 'email', 'mobile_number','company_name','type', 'salary', 'company_type', 'income_type', 'location_type', 'employee_type','location','message','status','created_at','updated_at','deleted_at'
    ];

    protected $appends = ['type_text', 'status_text'];

    public function getTypeTextAttribute()
    {
        return config('constant.loan_types')[$this->type];
    }

    public function getStatusTextAttribute()
    {
        return $this->status == 1?'Active':'InActive';
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
