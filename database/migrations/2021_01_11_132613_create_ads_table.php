<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adPositionId');
            $table->string('adFile',100);
            $table->string('adName',100);
            $table->string('adURL',100);
            $table->date('adStartDate');
            $table->date('adEndDate');
            $table->integer('adSort');
            $table->integer('adClickNum');
            $table->integer('positionType');
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
        Schema::dropIfExists('ads');
    }
}
