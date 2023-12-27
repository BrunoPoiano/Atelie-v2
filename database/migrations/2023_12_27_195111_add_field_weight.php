<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldWeight extends Migration
{
  protected $connection = 'exercise_mysql';

  public function up()
  {
    Schema::connection("exercise_mysql")->table('weight', function ($table) {
      $table->integer('user_id')->after('id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::connection("exercise_mysql")->table('weight', function ($table) {
      $table->dropcolumn(['user_id']);
    });
  }
}
