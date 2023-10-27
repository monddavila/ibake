<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizeOrder extends Model
{
    use HasFactory;

    protected $fillable = [ 
                                'id',
                                'userID',
                                'orderID',
                                'cakeSize',
                                'cakeFlavor',
                                'cakeFilling',
                                'cakeIcing',
                                'cakeTopBorder',
                                'cakeBottomBorder',
                                'cakeDecoration',
                                'cakeMessage',
                                'cakePrice',
                                'orderStatus',
                                'cake_size',
                                'cake_flavor',
                                'cake_icing',
                                'celebrant_name',
                                'celebrant_birthday',
                                'budget',
                                'shipping_method',
                                'delivery_date',
                                'delivery_time',
                                'address',
                        ];

    public function user()
    {
    return $this->belongsTo(User::class, 'userID');
    }

    public function customizeOrderDetail()
    {
    return $this->hasOne(CustomizeOrderDetail::class, 'customOrder_id', 'id');
    }

 
}
