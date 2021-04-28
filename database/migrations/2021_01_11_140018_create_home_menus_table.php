<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parentId');
            $table->string('menuName',255);
            $table->string('menuUrl',255);
            $table->string('menuOtherUrl',255);
            $table->integer('isShow');
            $table->integer('menuSort');
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
        Schema::dropIfExists('home_menus');
    }
}
