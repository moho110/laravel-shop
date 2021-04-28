<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parentId');
            $table->string('catName',100);
            $table->integer('isShow');
            $table->integer('isFloor');
            $table->integer('catSort');
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
        Schema::dropIfExists('goods_cats');
    }
}
