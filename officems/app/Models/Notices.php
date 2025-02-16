<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notices extends Model
{
    protected $fillable =[
        'create_date',
        'title',
        'role',
        'description',
    ];
}
