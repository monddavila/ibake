<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'name',
    'description',
    'created_at',
    'updated_at',
  ];

  public function products()
  {
        return $this->belongsToMany(Product::class, 'product_tags', 'tag_id', 'product_id');
  }
  



}
