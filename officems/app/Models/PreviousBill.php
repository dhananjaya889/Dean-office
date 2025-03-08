<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousBill extends Model
{
    use HasFactory;

    // Specify the table name (optional, only if it differs from the default "previous_bills")
    protected $table = 'previous_bills';

    // Specify the primary key (optional, only if it differs from the default "id")
    protected $primaryKey = 'id';

    // Disable auto-incrementing if using non-numeric primary key (optional)
    public $incrementing = true;

    // Specify which attributes are mass assignable
    protected $fillable = [
        'name', 
        'bill_id', 
        'date', 
        'month', 
        'amount', 
        'point', 
        'image', 
        'assign_user', 
        'assign_quartaz'
    ];

    // Specify any attributes that should be cast to a specific type
    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
        'point' => 'integer',
    ];

    // Optionally, you can define any relationships or additional functions


    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class, 'assign_user');
    }

    // Relationship with Quartz model
    public function quartz()
    {
        return $this->belongsTo(Quartaz::class, 'assign_quartaz');
    }
}
