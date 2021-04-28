<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderId');
            $table->integer('goodsId');
            $table->integer('goodsNum');
            $table->decimal('goodsPrice',10);
            $table->integer('goodsSpecId');
            $table->string('goodsSpecNames',200);
            $table->string('goodsName',200);
            $table->string('goodsImg',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_goods');
    }
}
