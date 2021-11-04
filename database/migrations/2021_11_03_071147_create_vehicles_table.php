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
      $table->unsignedBigInteger('brand_id');
      $table->unsignedBigInteger('department_id')->nullable(); // Allocated Department
      $table->unsignedBigInteger('vehicleType_id'); // Vehicle Pickup, Cover-Van etc.
      $table->unsignedBigInteger('driver_id')->nullable(); // Allocated Driver
      $table->unsignedBigInteger('helper_id')->nullable(); // Allocated Helper
      $table->boolean('is_running')->default(1); // Is Vehicle Currently Running or Not
      $table->tinyInteger('wheels')->nullable(); // Vehicle Wheels Count
      $table->smallInteger('cubic_capacity')->nullable(); // Vehicle Engine CC
      $table->date('purchase_date')->nullable();
      $table->date('sold_date')->nullable();

      $table->foreign('brand_id')
        ->references('id')->on('brands')->onUpdate('cascade');
      $table->foreign('department_id')
        ->references('id')->on('departments')->onUpdate('cascade');
      $table->foreign('vehicleType_id')
        ->references('id')->on('vehicle_types')->onUpdate('cascade');
      $table->foreign('driver_id')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('helper_id')
        ->references('id')->on('employees')->onUpdate('cascade');

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
