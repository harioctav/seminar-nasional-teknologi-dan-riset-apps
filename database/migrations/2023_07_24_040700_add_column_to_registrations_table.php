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
    Schema::table('registrations', function (Blueprint $table) {
      $table->enum('type', [Constant::UPLOAD, Constant::SEMINAR])->after('status');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('registrations', function (Blueprint $table) {
      $table->dropColumn('type');
    });
  }
};
