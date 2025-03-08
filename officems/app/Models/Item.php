<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_id',
        'name',
        'description',
    ];

    public function quarter()
    {
        return $this->belongsTo(Quartaz::class, 'quarter_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'quarter_id');
    }
}
