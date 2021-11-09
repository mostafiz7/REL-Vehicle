<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePartsTransactionsTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('parts_transactions', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('parts_tr_no')->unique(); // Parts Transaction Number
      $table->set('condition', ['old', 'new']); // Parts Condition
      $table->set('transact_type', ['vehicle_out', 'vehicle_in', 'scrap_sell']); // Parts Transaction-Type
      $table->unsignedBigInteger('vehicle_id')->nullable();
      $table->unsignedBigInteger('requisition_id')->nullable(); // Requirement ID
      $table->string('requisition_no')->nullable();
      $table->unsignedBigInteger('employee_id')->nullable(); // Mechanic Employee ID
      $table->string('mechanic_name')->nullable(); // If Mechanic is other than Employee
      $table->boolean('is_authorized')->default(0);
      $table->unsignedBigInteger('authorizer_id')->nullable(); // Authorized Employee ID
      $table->date('date'); // Parts Transaction Date
      $table->mediumInteger('quantity');
      $table->integer('amount')->nullable();
      $table->string('party_name')->nullable(); // If Parts sold as scrap
      $table->text('reference')->nullable();
      $table->text('note')->nullable();

      $table->foreign('vehicle_id')
        ->references('id')->on('vehicles')->onUpdate('cascade');
      $table->foreign('requisition_id')
        ->references('id')->on('requisitions')->onUpdate('cascade');
      $table->foreign('employee_id')
        ->references('id')->on('employees')->onUpdate('cascade');
      $table->foreign('authorizer_id')
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
    Schema::dropIfExists('parts_transactions');
  }

}
