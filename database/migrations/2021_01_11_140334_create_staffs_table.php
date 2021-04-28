<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('loginName',100);
            $table->string('loginPwd',100);
            $table->string('secretKey',10);
            $table->string('staffName',100);
            $table->string('staffNo',100);
            $table->string('staffPhoto',200);
            $table->integer('staffRoleId');
            $table->integer('workStatus');
            $table->integer('staffStatus');
            $table->integer('dataFlag');
            $table->datetime('createTime');
            $table->datetime('lastTime');
            $table->string('lastIP',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
