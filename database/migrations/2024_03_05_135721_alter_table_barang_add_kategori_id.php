<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('barang', function (Blueprint $table) {
      $table->foreignId('kategori_id')->after('id')->nullable();
      $table->foreign('kategori_id')->references('id')->on('kategori');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('barang', function (Blueprint $table) {
      $table->dropForeign(['kategori_id']);
      $table->dropColumn('kategori_id');
    });
  }
};
