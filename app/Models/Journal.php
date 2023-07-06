<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'user_id',
    'title',
    'excerpt',
    'abstract',
    'upload_year',
    'file',
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
   * Get the journal status.
   *
   */
  public function isStatus()
  {
    if ($this->status === Constant::DRAFT) :
      return '<span class="badge text-primary">' . Constant::DRAFT . '</span>';
    elseif ($this->status === Constant::IN_REVIEW) :
      return '<span class="badge text-warning">' . Constant::IN_REVIEW . '</span>';
    elseif ($this->status === Constant::IN_REVISION) :
      return '<span class="badge text-danger">' . Constant::IN_REVISION . '</span>';
    else :
      return '<span class="badge text-success">' . Constant::ACCEPTED . '</span>';
    endif;
  }

  /**
   * Get the journal status approved.
   *
   * @return void
   */
  public function isApproved()
  {
    if (!$this->is_approved) :
      return '<span class="badge text-warning">' . Constant::UN_PUBLISHED . '</span>';
    else :
      return '<span class="badge text-success">' . Constant::PUBLISHED . '</span>';
    endif;
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
   * Relation to Select Reviewer model.
   *
   * @return HasOne
   */
  public function selectReviewer(): HasOne
  {
    return $this->hasOne(SelectReviewer::class, 'journal_id');
  }
}
