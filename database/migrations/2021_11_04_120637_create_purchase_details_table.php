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
      $table->unsignedBigInteger('purchase_id');
      $table->unsignedBigInteger('parts_id');
      $table->string('unit');
      $table->integer('quantity');
      $table->integer('amount');

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
