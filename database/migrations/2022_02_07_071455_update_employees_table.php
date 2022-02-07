<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class UpdateEmployeesTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::table('employees', function (Blueprint $table) {
      //$table->string('email_personal')->nullable()->change();
      $table->dropUnique(['email_personal']);
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    /* Schema::table('employees', function (Blueprint $table) {
      //$table->dropForeign(['role_id', 'employee_id']);
      $table->dropColumn(['role_id', 'employee_id']);
    }); */
  }

}
