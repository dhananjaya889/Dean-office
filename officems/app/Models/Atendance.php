<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atendance extends Model
{
    protected $fillable =[
        'name',
        'present',
        'absent',
        'month',
        'user_type',
        'file_path',
        'emp_no',
    ];
}
