<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CustomizeOrder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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

    public static function getAllCustomerCustomRecords()
    {
        $result = CustomizeOrderDetail::with('user')
        ->where('order_status', '=', 'Completed')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($order) {
            $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
            $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
            $order->name = $order->user->firstname . ' ' . $order->user->lastname;
            $order->type = 'Custom Order';
            return $order;
        });
      
  

    return $result;
    }

    public static function getAllCustomOrders()
    {

        $result = DB::table('customize_order_details')
            ->select('customize_order_details.id', DB::raw('CONCAT(users.firstname, " ", users.lastname) as user_name'), 'customize_order_details.order_id', 'customize_order_details.recipient_name', 'customize_order_details.recipient_phone','customize_order_details.recipient_email', 'customize_order_details.shipping_method', 'customize_order_details.delivery_date', 'customize_order_details.delivery_time','customize_order_details.delivery_address',
            'customize_order_details.notes', 'customize_order_details.order_status', 'customize_order_details.total_price', 'customize_order_details.payment_method','customize_order_details.payment_status','customize_order_details.created_at')
            ->join('users', 'customize_order_details.user_id', '=', 'users.id')
            ->get()
            ->toArray();
    
        return $result;
    }

    public static function getAllCustomSales()
    {

        $result = DB::table('customize_order_details')
            ->select('customize_order_details.id', DB::raw('CONCAT(users.firstname, " ", users.lastname) as user_name'), 'customize_order_details.order_id',
            'customize_order_details.order_status', 'customize_order_details.payment_status', 'customize_order_details.payment_method', 'customize_order_details.payment_option', 'customize_order_details.total_price', 'customize_order_details.payment_balance','customize_order_details.created_at')
            ->whereIn('payment_status', ['Fully Paid', 'Partially Paid'])
            ->where('order_status', '!=', 'Cancelled')
            ->join('users', 'customize_order_details.user_id', '=', 'users.id')
            ->get()
            ->toArray();
    
        return $result;
    }


}
