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
    Schema::create('payment_methods', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->string('account_number')->unique();
      $table->string('account_name');
      $table->string('account_bank')->unique();
      $table->string('account_status')->default(Constant::INACTIVE);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payment_methods');
  }
};
