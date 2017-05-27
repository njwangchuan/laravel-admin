<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id')->unsigned();
      $table->string('username')->unique();
      $table->string('display_name');
      $table->string('email')->unique()->nullable();
      $table->string('phone',60)->unique()->nullable();
      $table->string('password', 60);
      $table->string('api_token', 60)->nullable();
      $table->string('confirmation_code')->nullable();
      $table->boolean('confirmed')->default(false);
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::drop('users');
  }
}
