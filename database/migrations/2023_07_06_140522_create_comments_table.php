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
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->foreignId('journal_id')->constrained()->onDelete('cascade');
      $table->string('batch');
      $table->string('file_revision')->nullable();
      $table->text('comment');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('comments');
  }
};
