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
    Schema::create('journals', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
      $table->string('title')->unique();
      $table->string('excerpt')->nullable();
      $table->text('abstract');
      $table->string('upload_year');
      $table->string('file', 190);
      $table->boolean('is_approved')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('journals');
  }
};
