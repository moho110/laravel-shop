<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goodsId');
            $table->integer('totalScore');
            $table->integer('totalUsers');
            $table->integer('goodsScore');
            $table->string('goodsUsers',20);
            $table->integer('serviceScore');
            $table->string('serviceUsers',20);
            $table->integer('timeScore');
            $table->string('timeUsers',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_scores');
    }
}
