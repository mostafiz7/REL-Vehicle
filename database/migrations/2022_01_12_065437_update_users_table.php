<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class UpdateUsersTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      // $table->boolean('active')->default(1)->after('username');
      // $table->tinyText('role')->after('password');
      // $table->tinyInteger('role_id')->after('role');
      $table->tinyInteger('role_id')->after('password');
      $table->unsignedBigInteger('employee_id')->unique()->after('role_id');

      $table->foreign('role_id')
        ->references('id')->on('roles')->onUpdate('cascade');
      $table->foreign('employee_id')
        ->references('id')->on('employees')->onUpdate('cascade');
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropForeign(['role_id', 'employee_id']);
      $table->dropColumn(['role_id', 'employee_id']);
    });
  }
}
