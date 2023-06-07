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
    Schema::create('transactions', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('user_id')
        ->constrained('users', 'id')
        ->onDelete('cascade');
      $table->date('upload_date');
      $table->integer('amount');
      $table->string('proof');
      $table->string('status')->default(Constant::PENDING);
      $table->longText('reason')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('transactions');
  }
};
