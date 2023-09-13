<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
  use HasFactory;
  protected $fillable = [
    'order_id',
    'product_id',
    'price',
    'quantity'
  ];

  public function orderItems()
  {
    return $this->belongsTo(Orders::class);
  }
}
