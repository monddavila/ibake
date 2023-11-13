<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

  public static function getAllShopCustomerRecords()
    {
      $result = Order::with('user')
      ->where('order_status', '=', 'Completed')
      ->orderBy('created_at', 'desc')
      ->get()
      ->map(function ($order) {
          $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
          $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
          $order->name = $order->user->firstname . ' ' . $order->user->lastname;
          $order->type = 'Shop Order';
          return $order;
      });
      
  

    return $result;
    }

    public static function getAllShopOrders()
    {

        $result = DB::table('orders')
            ->select('orders.id', DB::raw('CONCAT(users.firstname, " ", users.lastname) as user_name'), 'orders.order_id', 'orders.recipient_name', 'orders.recipient_phone','orders.recipient_email', 'orders.shipping_method', 'orders.delivery_date', 'orders.delivery_time','orders.delivery_address',
            'orders.notes', 'orders.order_status', 'orders.total_price', 'orders.payment_method','orders.payment_status','orders.created_at')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->get()
            ->toArray();
    
        return $result;
    }

    public static function getAllShopSales()
    {

        $result = DB::table('orders')
            ->select('orders.id', DB::raw('CONCAT(users.firstname, " ", users.lastname) as user_name'), 'orders.order_id',
            'orders.order_status', 'orders.payment_status', 'orders.payment_method', 'orders.total_price','orders.created_at')
            ->where('payment_status', 'Fully Paid')
            ->where('order_status', '!=', 'Cancelled')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->get()
            ->toArray();
    
        return $result;
    }


}
