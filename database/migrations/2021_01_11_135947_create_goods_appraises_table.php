<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAppraisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_appraises', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderId');
            $table->integer('goodsId');
            $table->integer('goodsSpecId');
            $table->integer('userId');
            $table->integer('goodsScore');
            $table->integer('serviceScore');
            $table->integer('timeScore');
            $table->string('content',255);
            $table->string('shopReply',255);
            $table->string('images',255);
            $table->integer('isShow');
            $table->integer('dataFlag');
            $table->datetime('createTime');
            $table->date('replyTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_appraises');
    }
}
