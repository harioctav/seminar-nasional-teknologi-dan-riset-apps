<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
  use HasFactory, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'user_id',
    'payment_id',
    'registration_id',
    'upload_date',
    'amount',
    'proof',
    'status',
    'description',
    'reason',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Scope a query to only include approved transaction.
   */
  public function scopeApproved($data)
  {
    return $data->where('status', Constant::APPROVED);
  }

  public function getApproved(): Collection
  {
    return $this->approved()->get();
  }

  /**
   * Relation to user model.
   *
   * @return BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * Relation to payment model.
   *
   * @return BelongsTo
   */
  public function payment(): BelongsTo
  {
    return $this->belongsTo(Payment::class, 'payment_id');
  }

  /**
   * Relation to registration model.
   *
   * @return BelongsTo
   */
  public function registration(): BelongsTo
  {
    return $this->belongsTo(Registration::class, 'registration_id');
  }
}
