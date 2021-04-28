<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogMoneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_moneys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('targetType');
            $table->integer('targetId');
            $table->integer('dataId');
            $table->integer('dataSrc');
            $table->string('remark',255);
            $table->integer('moneyType');
            $table->decimal('money',20);
            $table->string('tradeNo',255);
            $table->integer('payType');
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
        Schema::dropIfExists('log_moneys');
    }
}
