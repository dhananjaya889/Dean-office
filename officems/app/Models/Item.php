<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable =[
        'item_id',
        'name',
        'description',
    ];
}
