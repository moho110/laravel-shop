<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goodsCatId');
            $table->string('goodsCatPath',255);
            $table->string('catName',255);
            $table->integer('isAllowImg');
            $table->integer('isShow');
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
        Schema::dropIfExists('spec_cats');
    }
}
