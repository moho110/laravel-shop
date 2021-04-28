<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_specs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goodsId');
            $table->string('productNo',20);
            $table->string('specIds',255);
            $table->decimal('marketPrice');
            $table->decimal('specPrice');
            $table->integer('specStock');
            $table->integer('warnStock');
            $table->integer('saleNum');
            $table->integer('isDefault');
            $table->integer('dataFlag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_specs');
    }
}
