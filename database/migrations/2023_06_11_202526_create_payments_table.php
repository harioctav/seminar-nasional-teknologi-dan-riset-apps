<?php

use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('bank_id')->constrained('banks', 'id')->onDelete('cascade');
      $table->string('number')->unique();
      $table->string('holder_name');
      $table->string('status')->default(Constant::INACTIVE);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payments');
  }
};
