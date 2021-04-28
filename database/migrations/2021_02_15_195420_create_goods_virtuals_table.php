<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsVirtualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_virtuals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goodsId');
            $table->string('cardNo',255);
            $table->string('cardPwd',255);
            $table->integer('orderId');
            $table->string('orderNo',255);
            $table->integer('isUse');
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
        Schema::dropIfExists('goods_virtuals');
    }
}
