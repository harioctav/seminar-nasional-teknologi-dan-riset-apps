<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;

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
        'start' => '2023-07-01',
        'end' => '2023-07-22',
        'status' => Constant::CLOSE,
        'type' => Constant::UPLOAD,
      ],
      [
        'title' => 'Acara Seminar Batch Pertama',
        'start' => '2023-07-24',
        'end' => '2023-07-25',
        'status' => Constant::OPEN,
        'type' => Constant::SEMINAR,
      ],
    ];

    $collects = collect($items);
    foreach ($collects as $key => $value) :
      Registration::firstOrCreate($value);
    endforeach;
  }
}
