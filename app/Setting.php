<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable =[
        'type', 'key', 'value','created_at','updated_at','deleted_at'
    ];
}
