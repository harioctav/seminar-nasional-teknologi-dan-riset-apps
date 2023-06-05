<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
