<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
   * Get all user, exclude administrator.
   *
   * @param  mixed $query
   * @return void
   */
  public function scopeExcludeAdmin($query)
  {
    return $query->whereDoesntHave('roles', function ($q) {
      $q->where('name', Constant::ADMIN);
    });
  }

  /**
   * Get the user status account.
   *
   */
  public function isStatus()
  {
    if ($this->status == Constant::ACTIVE) :
      return '<span class="badge text-success">Active</span>';
    else :
      return '<span class="badge text-danger">Inactive</span>';
    endif;
  }

  /**
   * Scope a query to only include inactive users.
   */
  public function scopeInactive($data)
  {
    return $data->where('status', Constant::INACTIVE);
  }

  public function getInactive(): Collection
  {
    return $this->inactive()->get();
  }

  /**
   * Mengecek apakah user bisa melakukan transaksi atau tidak
   *
   * @return void
   */
  public function canCreateTransaction()
  {
    return $this->transactions()->where('status', Constant::PENDING)->count() === 0;
  }

  /**
   * Mengecek apakah status makalah yang di upload oleh user
   * Jika user masih memiliki makalah yang belum approve maka belum bisa melakukan upload jurnal kedua kalinya
   *
   * @return void
   */
  public function canUploadJournal()
  {
    return $this->journals()->where('is_approved', false)->exists();
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

  /**
   * Relation to transaction model.
   *
   * @return HasMany
   */
  public function transactions(): HasMany
  {
    return $this->hasMany(Transaction::class, 'user_id');
  }

  /**
   * Relation to journal model.
   *
   * @return HasMany
   */
  public function journals(): HasMany
  {
    return $this->hasMany(Journal::class, 'user_id');
  }

  /**
   * Relation to revision model.
   *
   * @return HasMany
   */
  public function revisions(): HasMany
  {
    return $this->hasMany(Revision::class, 'user_id');
  }
}
