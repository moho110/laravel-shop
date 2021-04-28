<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fromType');
            $table->integer('dataId');
            $table->string('imgPath',255);
            $table->integer('imgSize');
            $table->integer('isUse');
            $table->datetime('createTime');
            $table->string('fromTable',200);
            $table->integer('ownId');
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
        Schema::dropIfExists('images');
    }
}
