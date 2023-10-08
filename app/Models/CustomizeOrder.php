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
                                'orderStatus'
                        ];
}
