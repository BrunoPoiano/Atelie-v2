<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     protected $connection = 'exercise_mysql';

    public function up()
    {
        Schema::connection("exercise_mysql")->create('weight', function($table){
            $table->id();
            $table->double('weight')->default(0);
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
        Schema::connection('exercise_mysql')->dropIfExists('weight');
    }
}
