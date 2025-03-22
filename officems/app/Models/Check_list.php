<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check_list extends Model
{
    protected $fillable = [
        'user_id',
        'quartz_id',
        'no',
        'item',
        'available_qty',
        'working_qty',
        'damage_qty',
        'remark',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function quartaz()
    // {
    //     return $this->belongsTo(Quartaz::class);
    // }
}
