<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopItemTest extends Model
{
  use HasFactory;
  public $timestamps = false;

  protected $fillable = [
    'item_id',
    'name',
    'price',
    'item_description',
    'category',
  ];
}
