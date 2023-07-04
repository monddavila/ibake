<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
  use HasFactory;

  protected $fillable = [
    'order_id',
    'product_id',
    'product_name',
    'price',
    'quantity',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function orderItems()
  {
    return $this->hasMany(OrderItems::class);
  }
}
