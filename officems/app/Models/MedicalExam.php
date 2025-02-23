<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'year',
        'level',
        'semester',
        'registation_number',
        'contact_number',
        'degree_programe',
        'subject_details',
        'medical_details',
        'agree',
        'medical_image',
        'status',
    ];

    protected $casts = [
        'subject_details' => 'array',
        'medical_details' => 'array',
        'agree' => 'boolean',
    ];

}
