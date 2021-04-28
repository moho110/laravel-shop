<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderId');
            $table->integer('orderStatus');
            $table->string('logContent',255);
            $table->integer('logUserId');
            $table->integer('logType');
            $table->datetime('logTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_orders');
    }
}
