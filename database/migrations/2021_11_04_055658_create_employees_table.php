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
      $table->string('office_id')->unique()->nullable(); // Company Given Employee ID
      $table->string('name');
      $table->string('nickname')->nullable();
      $table->boolean('active')->default(1);

      // Personal Info
      $table->date('birth_date')->nullable();
      $table->string('father_name')->nullable();
      $table->string('mother_name')->nullable();
      $table->string('gender')->nullable();
      $table->string('marital_status')->nullable();
      $table->string('religion')->nullable();
      $table->string('primary_contact')->unique()->nullable();
      $table->string('secondary_contact')->unique()->nullable();
      $table->string('email_personal')->unique()->nullable();
      $table->string('email_official')->unique()->nullable();
      $table->string('present_address')->nullable();
      $table->string('permanent_address')->nullable();
      // address1, address2, city_village, post_office, post_code, police_station, district
      $table->string('country')->nullable();

      // Official Info
      $table->date('joining_date')->nullable();
      $table->date('confirmation_date')->nullable();
      $table->string('employment_status')->nullable(); // Permanent / Probation / Daily-Basis / Casual
      $table->unsignedBigInteger('designation_id')->nullable();
      $table->unsignedBigInteger('department_id')->nullable();
      $table->string('dept_position')->nullable();
      $table->string('company')->nullable();
      $table->string('signatory_role')->nullable();
      $table->string('work_location')->nullable();
      $table->boolean('is_resigned')->default(0); // Working / Resigned
      $table->boolean('in_leave')->default(0); // Working / In-Leave
      $table->integer('salary')->nullable();
      $table->json('salary_details')->nullable();
      $table->json('previous_salary')->nullable();
      $table->boolean('authorize_power')->default(0);
      // Employee has authorize-power to give order to purchase
      $table->boolean('purchase_power')->default(0); // Employee has purchase-power
      $table->unsignedBigInteger('user_id')->unique()->nullable(); // APPS User ID

      $table->foreign('designation_id')
        ->references('id')->on('designations')->onUpdate('cascade');
      $table->foreign('department_id')
        ->references('id')->on('departments')->onUpdate('cascade');
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
    Schema::dropIfExists('employees');
  }

}
