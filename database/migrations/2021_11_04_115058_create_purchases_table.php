<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePurchasesTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('purchases', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('purchase_no')->unique();
      $table->unsignedBigInteger('requisition_id')->nullable(); // Requirement ID
      $table->unsignedBigInteger('user_id')->nullable(); // Purchaser User ID
      $table->unsignedBigInteger('employee_id')->nullable(); // Purchaser Employee ID
      $table->string('purchaser_name')->nullable(); // If un-authorized person purchased
      $table->unsignedBigInteger('supplier_id')->nullable(); // Parts Supplier ID
      $table->string('supplier_name')->nullable(); // Parts Supplier Name
      $table->unsignedBigInteger('vehicle_id')->nullable();
      $table->date('purchase_date');
      $table->string('shop_name');
      $table->string('shop_slug')->index();
      $table->string('shop_location');
      $table->string('memo_no')->index(); // Shop Bill Number
      $table->string('item_unit')->nullable(); // Purchased Item Unit
      $table->integer('total_qty');
      $table->integer('total_amount'); // Total Memo / Bill Amount
      $table->boolean('is_paid');
      $table->boolean('is_partial_paid')->nullable();
      $table->integer('paid_amount');
      $table->integer('due_amount')->nullable();
      $table->boolean('is_authorized');
      $table->unsignedBigInteger('authorizer_id')->nullable(); // Authorized Employee ID
      $table->set('purchase_type', ['vehicle', 'vehicle_parts', 'electrical', 'electronics', 'stationary', 'furniture']);

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('purchases');
  }
}
