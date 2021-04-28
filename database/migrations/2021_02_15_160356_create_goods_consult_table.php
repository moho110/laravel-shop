<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsConsultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_consult', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goodsId');
            $table->integer('userId');
            $table->integer('consultType');
            $table->string('consultContent',255);
            $table->datetime('createTime');
            $table->string('reply',255);
            $table->datetime('replyTime');
            $table->integer('dataFlag');
            $table->integer('isShow');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_consult');
    }
}
