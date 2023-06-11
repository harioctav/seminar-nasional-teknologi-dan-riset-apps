<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $csv = array_map('str_getcsv', file(public_path('assets/csv/bank.csv')));
    $collect = collect($csv);
    $datas = $collect->map(function ($data) {
      return [
        'name' => $data[0],
        'code' => $data[1],
      ];
    });

    foreach ($datas as $key => $value) :
      Bank::firstOrCreate($value);
    endforeach;
  }
}
