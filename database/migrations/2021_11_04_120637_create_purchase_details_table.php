<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePurchaseDetailsTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('purchase_details', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('type');
      // Purchase-Type: Vehicle, Vehicle-Parts, Electrical, Electronics, 'stationary', Furniture
      $table->unsignedBigInteger('purchase_id');
      $table->string('purchase_no');
      $table->unsignedBigInteger('parts_id');
      $table->unsignedBigInteger('vehicle_id')->nullable();
      $table->string('serial')->nullable();
      $table->string('size')->nullable();
      $table->string('unit');
      $table->decimal('rate', $precision = 10, $scale = 2)->nullable(); // Unit Price
      $table->integer('quantity');
      $table->decimal('amount', $precision = 12, $scale = 2)->nullable();
      $table->string('remarks')->nullable();

      $table->foreign('purchase_id')
        ->references('id')->on('purchases')
        ->onUpdate('cascade')->onDelete('cascade');
      $table->foreign('parts_id')
        ->references('id')->on('parts')->onUpdate('cascade');
      $table->foreign('vehicle_id')
        ->references('id')->on('vehicles')->onUpdate('cascade');

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('purchase_details');
  }
}
