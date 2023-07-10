<?php

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
    Schema::table('publishes', function (Blueprint $table) {
      $table->string('uuid')->unique()->after('id');
      $table->string('publish_code')->unique()->after('uuid');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('publishes', function (Blueprint $table) {
      $table->dropColumn('uuid');
    });
  }
};
