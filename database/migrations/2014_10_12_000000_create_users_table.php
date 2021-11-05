<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->uuid('uid')->unique();
      $table->string('name');
      $table->string('email')->unique();
      $table->string('username')->unique();
      $table->boolean('active')->default(1);
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->unsignedBigInteger('employee_id')->unique()->nullable();
      $table->json('permissions');
      $table->json('routes');

      $table->foreign('employee_id')
        ->references('id')->on('employees')->onUpdate('cascade');

      $table->rememberToken();
      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
