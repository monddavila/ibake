<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getAllCustomReview()
    {
        $result = DB::table('custom_cake_reviews')
            ->select('custom_cake_reviews.id', 'custom_cake_reviews.order_id', DB::raw('CONCAT(users.firstname, " ", users.lastname) as user_name'), 'custom_cake_reviews.comment', 'custom_cake_reviews.rating', 'custom_cake_reviews.created_at', 'custom_cake_reviews.updated_at')
            ->join('users', 'custom_cake_reviews.user_id', '=', 'users.id')
            ->get()
            ->toArray();
    
        return $result;
    }
}
