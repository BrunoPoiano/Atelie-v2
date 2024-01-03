<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotokmsTable extends Migration
{
    protected $connection = 'exercise_mysql';

    public function up()
    {
        Schema::connection("exercise_mysql")->create('motokms', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->after('id');
            $table->double('km')->default(0);
            $table->double('liters')->default(0);
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
        Schema::connection("exercise_mysql")->dropIfExists('motokms');
    }
}
