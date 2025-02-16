<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quartaz extends Model
{
    protected $table = "quartaz";
    
    protected $fillable =[
        'num',
        'address',
        'description',
        'status',
    ];
}
