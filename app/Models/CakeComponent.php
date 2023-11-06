<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakeComponent extends Model
{
  use HasFactory;

  protected $fillable = [
    'layer',
    'name',
    'color',
    'availability',
    'created_at',
    'updated_at',
  ];

  



}
