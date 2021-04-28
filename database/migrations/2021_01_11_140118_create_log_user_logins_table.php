<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogUserLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_user_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');
            $table->datetime('loginTime');
            $table->string('loginIp',20);
            $table->integer('loginSrc');
            $table->string('loginRemark',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_user_logins');
    }
}
