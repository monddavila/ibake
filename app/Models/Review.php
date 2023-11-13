<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
        
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getAllReview()
    {
    $result = DB::table('reviews')
        ->select('reviews.id', 'products.name as product_name', DB::raw('CONCAT(users.firstname, " ", users.lastname) as user_name'), 'reviews.comment', 'reviews.rating', 'reviews.created_at', 'reviews.updated_at')
        ->join('products', 'reviews.product_id', '=', 'products.id')
        ->join('users', 'reviews.user_id', '=', 'users.id')
        ->get()
        ->toArray();

    return $result;
    }


}
