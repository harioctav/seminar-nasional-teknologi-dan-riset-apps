<?php

use App\Helpers\Global\Constant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('registrations', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->string('title')
        ->unique()
        ->nullable();
      $table->date('start');
      $table->date('end');
      $table->string('status')->default(Constant::CLOSE);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('registrations');
  }
};
