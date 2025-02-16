<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuartazUser extends Model
{
    protected $fillable =[
        'quartaz_id',
        'user_id',
    ];
}
