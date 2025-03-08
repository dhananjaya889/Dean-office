<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousQuartaz extends Model
{
    use HasFactory;

    protected $table = 'previous_quartaz';

    protected $fillable = ['num', 'address', 'description', 'status'];
}

