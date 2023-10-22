<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\CustomizeOrder;


class CustomizeOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customOrder_id',
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
        'payment_option',
        'payment_status',
        'payment_balance',
        'payment_session_id',
        'payment_intent_id',
        'order_status',
        'created_at',
        'updated_at',
        'notes',
    ];

    // Define any relationships, if applicable
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customizeOrder()
    {
    return $this->belongsTo(CustomizeOrder::class, 'customOrder_id', 'id');
    }


}
