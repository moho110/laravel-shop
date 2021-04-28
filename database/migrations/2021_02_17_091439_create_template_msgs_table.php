<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateMsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_msgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tplType');
            $table->string('tplCode',50);
            $table->string('tplExternaId',255);
            $table->string('tplContent',255);
            $table->integer('isEnbale');
            $table->string('tplDesc',255);
            $table->integer('dataFlag');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_msgs');
    }
}
