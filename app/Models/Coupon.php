<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
  use HasFactory;

  protected $fillable = [
    'code',
    'discount_type',
    'discount_value',
    'expiration_date',
    'usage_limit',
    'used_count',
    'updated_at',
  ];

  



}
