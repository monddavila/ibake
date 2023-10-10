<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'order_id',
    'recipient_name',
    'recipient_email',
    'recipient_phone',
    'shipping_method',
    'delivery_date',
    'delivery_time',
    'delivery_address',
    'total_price',
    'payment_method',
    'payment_status',
    'payment_session_id',
    'payment_intent_id',
    'order_status',
    'created_at',
    'updated_at',
    'notes',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function orderItems()
  {
    return $this->hasMany(OrderItem::class);
  }
}
