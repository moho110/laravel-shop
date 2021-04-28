<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crons', function (Blueprint $table) {
            $table->integer('id');
            $table->string('cronName',100);
            $table->string('cronCode',20);
            $table->integer('isEnable');
            $table->integer('isRunning');
            $table->string('cronJson',255);
            $table->string('cronUrl',255);
            $table->string('cronDesc',255);
            $table->integer('cronCycle');
            $table->integer('cronDay');
            $table->integer('cronWeek');
            $table->integer('cronHour');
            $table->string('cronMinute',255);
            $table->string('runTime',20);
            $table->string('nextTime',20);
            $table->integer('isRunSuccess');
            $table->string('author',255);
            $table->string('authorUrl',255);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crons');
    }
}
