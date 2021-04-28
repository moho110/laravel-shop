<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orderNo',100);
            $table->string('userId',10);
            $table->decimal('goodsMoney',10);
            $table->integer('deliverType');
            $table->decimal('deliverMoney',10);
            $table->decimal('totalMoney',10);
            $table->decimal('realTotalMoney',10);
            $table->integer('orderStatus');
            $table->integer('payType');
            $table->integer('payFrom');
            $table->integer('isPay');
            $table->integer('areaId');
            $table->string('areaIdPath',255);
            $table->string('userName',255);
            $table->string('userAddress',255);
            $table->string('userPhone',100);
            $table->integer('orderScore');
            $table->integer('isInvoice');
            $table->integer('invoiceClient');
            $table->string('orderRemarks',255);
            $table->integer('orderSrc');
            $table->decimal('needPay',10);
            $table->string('isRefund',100);
            $table->integer('isAppraise');
            $table->integer('cancelReason');
            $table->integer('rejectReason');
            $table->string('rejectOtherReason',255);
            $table->integer('isClosed');
            $table->string('goodsSearchKeys',255);
            $table->datetime('receiveTime');
            $table->datetime('deliveryTime');
            $table->integer('expressId');
            $table->string('expressNo',200);
            $table->string('tradeNo',200);
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
        Schema::dropIfExists('orders');
    }
}
