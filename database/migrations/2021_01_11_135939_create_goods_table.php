<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goodsSn',500);
            $table->string('productNo',500);
            $table->string('goodsName',500);
            $table->string('goodsImg',500);
            $table->decimal('marketPrice',20);
            $table->decimal('shopPrice',20);
            $table->integer('warnStock');
            $table->integer('goodsStock');
            $table->string('goodsUnit',500);
            $table->string('goodsTips',500);
            $table->integer('isSale');
            $table->integer('isBest');
            $table->integer('isHot');
            $table->integer('isNew');
            $table->integer('isRecom');
            $table->string('goodsCatIdPath',255);
            $table->integer('goodsCatId');
            $table->integer('brandId');
            $table->string('goodsDesc',255);
            $table->integer('saleNum');
            $table->datetime('saleTime');
            $table->integer('visitNum');
            $table->integer('appraiseNum');
            $table->string('gallery',255);
            $table->string('goodsSeoKeywords',255);
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
        Schema::dropIfExists('goods');
    }
}
