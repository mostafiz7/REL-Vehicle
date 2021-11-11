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
      $table->set('type', ['vehicle', 'vehicle-parts', 'electrical', 'electronics', 'stationary', 'furniture']);
      $table->unsignedBigInteger('vehicle_id')->nullable();
      $table->unsignedBigInteger('requisition_id')->nullable(); // Requirement ID
      $table->string('requisition_no')->nullable();
      $table->unsignedBigInteger('purchaser_id')->nullable(); // Purchaser Employee ID
      $table->string('purchaser_name')->nullable(); // If Purchaser is other than Employee
      $table->unsignedBigInteger('supplier_id')->nullable(); // Parts Supplier ID
      $table->string('supplier_name')->nullable(); // Parts Supplier Name
      $table->date('date');
      $table->string('shop_name');
      $table->string('shop_slug')->index();
      $table->string('shop_contact')->index();
      $table->string('shop_location');
      $table->string('memo_no')->index(); // Shops Memo or Bill Number
      $table->integer('total_qty');
      $table->integer('total_amount'); // Memo or Bill Total Amount
      $table->boolean('is_paid')->default(0);
      $table->boolean('is_partial_paid')->nullable();
      $table->integer('paid_amount')->nullable();
      $table->integer('due_amount')->nullable();
      $table->boolean('is_billed')->default(0);
      $table->unsignedBigInteger('bill_id')->nullable(); // Is Bill done for this purchase?
      $table->string('bill_no')->nullable();
      $table->boolean('is_authorized')->default(0);
      $table->unsignedBigInteger('authorizer_id')->nullable(); // Authorized Employee ID
      $table->unsignedBigInteger('user_id')->nullable(); // Purchase Entry-By APP User
      $table->string('entry_by')->nullable(); // If Purchase Entry-By other than APP User

      $table->foreign('vehicle_id')
        ->references('id')->on('vehicles')->onUpdate('cascade');
      $table->foreign('requisition_id')
        ->references('id')->on('requisitions')->onUpdate('cascade');
      $table->foreign('purchaser_id')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('supplier_id')
        ->references('id')->on('suppliers')->onUpdate('cascade');
      $table->foreign('bill_id')
        ->references('id')->on('bills')->onUpdate('cascade');
      $table->foreign('authorizer_id')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('user_id')
        ->references('id')->on('users')->onUpdate('cascade');

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
