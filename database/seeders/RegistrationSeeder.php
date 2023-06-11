<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegistrationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      [
        'title' => 'Jadwal Upload Makalah',
        'start' => '2023-06-06',
        'end' => '2023-06-16',
        'status' => Constant::OPEN,
      ],
      [
        'title' => 'Jadwal Acara Seminar',
        'start' => '2023-06-24',
        'end' => '2023-06-25',
        'status' => Constant::CLOSE,
      ],
    ];

    $collects = collect($items);
    foreach ($collects as $key => $value) :
      Registration::firstOrCreate($value);
    endforeach;
  }
}
