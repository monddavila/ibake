<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
  use SoftDeletes;
  use HasApiTokens;
  use HasFactory;
  use HasProfilePhoto;
  use Notifiable;
  use TwoFactorAuthenticatable;

  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'firstname',
    'lastname',
    'email',
    'phone',
    'address',
    'password',
    'role_id',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array<int, string>
   */
  protected $appends = [
    'profile_photo_url',
  ];

  public function cart()
  {
    return $this->hasOne(Cart::class);
  }

  public function userCustomizeOrderDetail()
  {
    return $this->hasMany(CustomizeOrderDetail::class);
  }

  public function role()
  {
    return $this->belongsTo(Role::class, 'role_id');
  }

  public static function getAllUser()
  {
    $result = DB::table('users')
        ->select('users.id', 'users.firstname', 'users.lastname', 'users.email', 'roles.name as role_name', 'users.phone', 'users.address', 'users.created_at')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->get()
        ->toArray();

    return $result;
  }



}
