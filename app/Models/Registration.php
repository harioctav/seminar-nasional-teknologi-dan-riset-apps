<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Registration extends Model
{
  use HasFactory, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'title',
    'start',
    'end',
    'status',
    'type',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'start' => 'date:c',
    'end' => 'date:c',
  ];

  /**
   * Get the user status account.
   *
   */
  public function isStatus()
  {
    if ($this->status === Constant::OPEN) :
      return '<span class="badge text-success">' . Constant::OPEN .  '</span>';
    else :
      return '<span class="badge text-danger">' . Constant::CLOSE .  '</span>';
    endif;
  }

  public function isType()
  {
    if ($this->type === Constant::UPLOAD) :
      return '<span class="badge text-info">' . Constant::UPLOAD .  '</span>';
    else :
      return '<span class="badge text-warning">' . Constant::SEMINAR .  '</span>';
    endif;
  }

  /**
   * Relation to certificate model.
   *
   * @return HasOne
   */
  public function certificate(): HasOne
  {
    return $this->hasOne(Certificate::class, 'registration_id');
  }

  /**
   * Relation to transaction model.
   *
   * @return HasOne
   */
  public function transaction(): HasOne
  {
    return $this->hasOne(Transaction::class, 'registration_id');
  }
}
