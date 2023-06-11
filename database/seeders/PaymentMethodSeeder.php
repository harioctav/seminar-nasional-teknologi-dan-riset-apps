<?php

namespace Database\Seeders;

use App\Helpers\Global\Constant;
use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $datas = [
      [
        'account_number' => '5410401330',
        'account_name' => 'Admin Semnastera',
        'account_bank' => 'BANK CENTRAL ASIA',
        'account_status' => Constant::ACTIVE,
      ],
      [
        'account_number' => '1111222233333',
        'account_name' => 'Admin Semnastera',
        'account_bank' => 'BANK MANDIRI',
        'account_status' => Constant::ACTIVE,
      ],
    ];

    $collects = collect($datas);
    foreach ($collects as $key => $value) :
      PaymentMethod::firstOrCreate($value);
    endforeach;
  }
}
