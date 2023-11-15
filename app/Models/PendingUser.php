<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'phone',
        'address',
        'token',
        'created_at',
        'updated_at',
        
    ];

    protected $hidden = [
        'password',
        'token',
      ];


}
