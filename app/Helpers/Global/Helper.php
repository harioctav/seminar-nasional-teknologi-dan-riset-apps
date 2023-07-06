<?php

namespace App\Helpers\Global;

use Illuminate\Support\Facades\DB;

class Helper
{
  public static function customDate($date, $show_day = true)
  {
    $date_name  = array(
      'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'
    );

    $month_name = array(
      1 =>
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $tahun   = substr($date, 0, 4);
    $bulan   = $month_name[(int) substr($date, 5, 2)];
    $tanggal = substr($date, 8, 2);
    $text    = '';

    if ($show_day) {
      $urutan_hari = date('w', mktime(0, 0, 0, substr($date, 5, 2), $tanggal, $tahun));
      $hari = $date_name[$urutan_hari];
      $text .= "$hari, $tanggal $bulan $tahun";
    } else {
      $text .= "$tanggal $bulan $tahun";
    }

    return $text;
  }

  public static function formatRupiah($value)
  {
    $format = "Rp " . number_format($value, 0, ',', '.');
    return $format;
  }

  public static function autoNumber($table = NULL, $field = NULL, $pattern = NULL, $digit = NULL)
  {
    $last = DB::table($table)
      ->select(DB::raw('MAX(CAST(SUBSTRING(' . $field . ',' . (strlen($pattern) + 1) . ') AS UNSIGNED)) as lastno'))
      ->where($field, 'LIKE', $pattern . '%')
      ->first();

    if (!empty($last)) {
      $next = $last->lastno + 1;
    } else {
      $next = 1;
    }

    return $pattern . sprintf("%0" . $digit . "s", $next);
  }
}
