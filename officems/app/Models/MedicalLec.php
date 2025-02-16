<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalLec extends Model
{
    use HasFactory;
    protected $fillable = [
        'st_name',
        'st_address',
        'st_contact',
        'register_number',
        'academic_year',
        'level',
        'semester_year',
        'degree_programe',
        'subject_details',
        'medical_image',
    ];

    protected $casts = [
        'subject_details' => 'array',
    ];
}
