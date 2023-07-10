<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publish extends Model
{
  use HasFactory, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'journal_id',
    'publish_code',
    'publish_date',
    'is_active',
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
    'publish_date' => 'date:c',
  ];

  /**
   * Get the journal status approved.
   *
   * @return void
   */
  public function isActive()
  {
    if (!$this->is_active) :
      return '<span class="badge text-dark">Diarsipkan</span>';
    else :
      return '<span class="badge text-success">Active</span>';
    endif;
  }

  /**
   * Get data in active.
   *
   * @param  mixed $data
   * @return void
   */
  public function scopeActive($data)
  {
    return $data->where('is_active', Constant::ACTIVE);
  }

  public function getActive(): Collection
  {
    return $this->active()->get();
  }

  /**
   * Relation to journal model.
   *
   * @return BelongsTo
   */
  public function journal(): BelongsTo
  {
    return $this->belongsTo(Journal::class, 'journal_id');
  }
}
