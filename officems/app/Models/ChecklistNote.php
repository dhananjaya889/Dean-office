<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistNote extends Model
{
    protected $fillable = [
        'note',
        'user_id',
        'quartaz_id',
    ];
}
