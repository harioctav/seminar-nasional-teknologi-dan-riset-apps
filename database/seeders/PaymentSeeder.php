<?php

namespace Database\Seeders;

use App\Helpers\Global\Constant;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      [
        'bank_id' => 8,
        'number' => '0381046132',
        'holder_name' => 'Aldiama Hari Octavian Y',
        'status' => Constant::ACTIVE,
      ],
      [
        'bank_id' => 4,
        'number' => '1820012350708',
        'holder_name' => 'Aldiama Hari Octavia',
        'status' => Constant::ACTIVE,
      ],
    ];

    $collects = collect($items);
    foreach ($collects as $key => $value) :
      Payment::firstOrCreate($value);
    endforeach;
  }
}
