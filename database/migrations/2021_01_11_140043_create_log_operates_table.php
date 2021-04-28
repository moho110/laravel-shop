<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogOperatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_operates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staffId');
            $table->datetime('operateTime');
            $table->integer('menuId');
            $table->string('operateDesc',255);
            $table->string('operateUrl',255);
            $table->string('content',255);
            $table->string('operateIP',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_operates');
    }
}
