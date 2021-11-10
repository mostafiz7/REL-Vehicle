<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateEmployeesTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('employees', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('office_id')->unique(); // Company Given Employee ID
      $table->string('name');
      $table->string('nickname')->nullable();
      $table->boolean('active')->default(1);
      $table->unsignedBigInteger('designation_id')->nullable(); // APPS User ID
      $table->unsignedBigInteger('department_id')->nullable(); // APPS User ID
      $table->boolean('authorize_power')->default(0);
      // Employee has authorize-power to give order to purchase
      $table->boolean('purchase_power')->default(0); // Employee has purchase-power

      // Personal Info
      /*
      $table->date('birth_date')->nullable();
      $table->string('father_name')->nullable();
      $table->string('mother_name')->nullable();
      $table->string('gender')->nullable();
      $table->string('marital_status')->nullable();
      $table->string('religion')->nullable();
      $table->string('contact_no')->unique()->nullable();
      $table->string('email_personal')->unique()->nullable();
      $table->string('email_official')->unique()->nullable();
      $table->string('address1')->nullable();
      $table->string('address2')->nullable();
      $table->string('city_village')->nullable();
      $table->string('post_office')->nullable();
      $table->string('post_code')->nullable();
      $table->string('police_station')->nullable();
      $table->string('district')->nullable();
      $table->string('country')->nullable();

      // Official Info
      $table->date('joining_date');
      $table->date('confirmation_date')->nullable();
      $table->string('dept_position');
      $table->string('company');
      $table->string('signatory_role')->nullable();
      $table->string('work_location')->nullable();
      $table->boolean('is_resigned')->default(0); // Working / Resigned
      $table->boolean('in_leave')->default(0); // Working / In-Leave
      $table->string('employment_status'); // Permanent / Probation / Casual / Daily-Basis
      $table->integer('salary')->nullable();
      $table->json('salary_details')->nullable();
      */

      $table->foreign('designation_id')
        ->references('id')->on('designations')->onUpdate('cascade');
      $table->foreign('department_id')
        ->references('id')->on('departments')->onUpdate('cascade');

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('employees');
  }

}
