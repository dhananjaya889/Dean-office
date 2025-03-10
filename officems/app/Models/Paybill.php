<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paybill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'bill_id',
        'ref_id',
        'image',
        'bill_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quartaz()
    {
        return $this->belongsTo(Quartaz::class);
    }
}

