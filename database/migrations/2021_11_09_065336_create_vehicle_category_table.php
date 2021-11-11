<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateVehicleCategoryTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('vehicle_category', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('name')->unique();
      $table->string('slug')->unique();

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('vehicle_category');
  }

}