<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousItem extends Model
{
    use HasFactory;

    protected $table = 'previous_items';

    protected $fillable = [
        'item_id',
        'name',
        'item_add_date',
        'description',
        'quartaz_num'
    ];
}
