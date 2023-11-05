<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakeBuilderDetail extends Model
{
  use HasFactory;

  protected $fillable = [
    'size',
    'price',
    'created_at',
    'updated_at',
  ];

  



}
