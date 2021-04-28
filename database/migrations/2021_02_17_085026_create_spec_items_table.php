<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shopId');
            $table->integer('catId');
            $table->integer('goodsId');
            $table->string('itemName',255);
            $table->string('itemDesc',255);
            $table->string('itemImg',255);
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
        Schema::dropIfExists('spec_items');
    }
}
