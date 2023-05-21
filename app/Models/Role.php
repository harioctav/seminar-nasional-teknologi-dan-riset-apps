<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelRole;

class Role extends ModelRole
{
  use HasFactory, Uuid;

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }
}
