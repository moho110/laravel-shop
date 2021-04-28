<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_refunds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderId');
            $table->integer('refundTo');
            $table->string('refundReson',255);
            $table->string('refundOtherReson',255);
            $table->decimal('backMoney',11);
            $table->string('refundTradeNo',200);
            $table->string('refundRemark',500);
            $table->datetime('refundTime');
            $table->string('shopRejectReason',255);
            $table->integer('refundStatus');
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
        Schema::dropIfExists('order_refunds');
    }
}
