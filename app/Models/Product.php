<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'image',
        'item_description',
        'category_id', // id of category - foreign key from categories table
        'rating',
        'availability',
        'isfeatured', 
    ];

    //Relationship to Categories table
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    } 

    public function reviews()
    {
    return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public static function getAllProduct()
    {
    $result = DB::table('products')
        ->select('products.id', 'products.name', 'products.price', 'products.item_description', 'categories.name as category_name', 'products.rating', 'products.available_qty', 'products.availability', 'products.isfeatured', 'products.created_at')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->get()
        ->toArray();

    return $result;
    }


    
}
