<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenances';

    protected $fillable = [
        'user_id',
        'item_id',
        'description',
        'image',
        'admin_approve',
        'mainten_status',
        'maintenance_description',
        'user_status',
    ];
}
