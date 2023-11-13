<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderItem extends Model
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
    return $this->belongsTo(Order::class);
  }

  public function product()
  {
      return $this->belongsTo(Product::class);
  }

  public static function getAllSoldProducts()
  {
    $result = DB::table('order_items')
    ->select('products.name as product_name', 'order_items.product_id', 'order_items.quantity', 'order_items.price', DB::raw('SUM(order_items.quantity) as total_quantity'), DB::raw('SUM(order_items.price) as total_price'))
    ->join('products', 'order_items.product_id', '=', 'products.id')
    ->groupBy('products.name', 'order_items.product_id', 'order_items.quantity', 'order_items.price')
    ->orderByDesc('total_quantity')
    ->get();

        

    return $result;
  }

}
