<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('targetType');
            $table->integer('targetId');
            $table->integer('accType');
            $table->integer('accTargetId');
            $table->integer('accAreaId');
            $table->string('accNo',200);
            $table->string('accUser',200);
            $table->integer('dataFlag');
            $table->datetime('createTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_configs');
    }
}
