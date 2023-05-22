<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Uuid;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'name',
    'email',
    'phone',
    'password',
    'avatar',
    'status',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
   * Get the user role name.
   */
  public function isRoleName(): string
  {
    return $this->roles->implode('name');
  }

  /**
   * Get the user role id.
   */
  public function isRoleId(): int
  {
    return $this->roles->implode('id');
  }

  /**
   * Get the user avatar.
   *
   */
  public function getAvatar()
  {
    if (!$this->avatar) {
      return asset('assets/images/default.png');
    } else {
      return Storage::url($this->avatar);
    }
  }

  /**
   * Relation into client model.
   *
   * @return HasOne
   */
  public function client(): HasOne
  {
    return $this->hasOne(Client::class, 'user_id');
  }
}
