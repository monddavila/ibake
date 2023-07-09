<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'recipient_name',
    'recipient_email',
    'recipient_phone',
    'email',
    'delivery_date',
    'delivery_time',
    'delivery_address',
    'order_status',
    'total_price',
    'payment_method',
    'notes',
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
