<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_sms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('smsSrc');
            $table->integer('smsUserId');
            $table->string('smsContent',255);
            $table->integer('smsPhoneNumber');
            $table->string('smsReturnCode',255);
            $table->string('smsCode',20);
            $table->string('smsFunc',20);
            $table->string('smsIP',200);
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
        Schema::dropIfExists('log_sms');
    }
}
