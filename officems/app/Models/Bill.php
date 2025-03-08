<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
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

    public function user()
    {
        return $this->belongsTo(User::class, 'assign_user', 'id');
    }

    public function quartaz()
    {
        return $this->belongsTo(Quartaz::class,'assign_quartaz', 'id');
    }

}

