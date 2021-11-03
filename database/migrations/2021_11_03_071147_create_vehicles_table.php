<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateVehiclesTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('vehicles', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('vehicle_no')->unique(); // Vehicle Registration Number
      $table->string('slug')->unique();
      $table->unsignedBigInteger('brand_id')->nullable();
      $table->unsignedBigInteger('department_id')->nullable(); // Allocated Department
      $table->unsignedBigInteger('vehicleType_id')->nullable(); // Vehicle Type
      $table->boolean('running')->default(1); // Is Vehicle Currently Running or Not
      $table->tinyInteger('wheels')->nullable(); // Vehicle Wheels
      $table->smallInteger('cubic_capacity')->nullable(); // Vehicle Engine CC
      $table->date('purchase_date')->nullable();
      $table->date('sold_date')->nullable();

      $table->foreign('brand_id')
        ->references('id')->on('brands')->onUpdate('cascade');
      $table->foreign('department_id')
        ->references('id')->on('departments')->onUpdate('cascade');
      $table->foreign('vehicleType_id')
        ->references('id')->on('vehicle_types')->onUpdate('cascade');

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('vehicles');
  }
}
