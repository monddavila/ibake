<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomCakeReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'rating',
        'comment',
        
    ];

    public function customizeOrder()
    {
        return $this->belongsTo(CustomizeOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
