<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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

    
}
