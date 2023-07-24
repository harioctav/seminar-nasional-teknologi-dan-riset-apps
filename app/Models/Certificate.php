<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
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
    'code',
    'generate_date',
    'image',
  ];

  public static function generateCode(string $year)
  {
    // Ambil jumlah data dengan nomor yang dimulai dengan tahun saat ini
    $count = self::where('code', 'like', "%{$year}%")->count();

    // Buat nomor otomatis dengan format yang diinginkan
    $code = str_pad($count + 1, 4, '0', STR_PAD_LEFT) . "/POLSMI.C10/PN/X/{$year}";
    return $code;
  }

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
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
}
