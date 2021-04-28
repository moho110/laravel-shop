<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendlinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friendlinks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('friendlinkIco',150);
            $table->string('friendlinkName',150);
            $table->string('friendlinkUrl',150);
            $table->integer('friendlinkSort');
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
        Schema::dropIfExists('friendlinks');
    }
}
