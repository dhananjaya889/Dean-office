<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable =[
        'name',
        'bill_id',
        'date',
        'month',
        'amount',
        'point',
        'image',
        'assign_user',
        'assign_quartaz',
    ];
}
