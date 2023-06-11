<?php

namespace App\Models;

use App\Models\Bank;
use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
  use HasFactory, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'bank_id',
    'number',
    'holder_name',
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
   * Mengambil semua data metode pembayaran yang berstatus aktif.
   *
   * @param  mixed $data
   * @return void
   */
  public function scopeActive($data)
  {
    return $data->where('status', Constant::ACTIVE);
  }

  public function getActive(): Collection
  {
    return $this->active()->get();
  }

  /**
   * Relation to bank model.
   *
   * @return BelongsTo
   */
  public function bank(): BelongsTo
  {
    return $this->belongsTo(Bank::class, 'bank_id');
  }
}
