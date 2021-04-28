<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catId');
            $table->string('articleTitle',255);
            $table->integer('isShow');
            $table->string('articleContent',255);
            $table->string('articleKey',255);
            $table->integer('staffId');
            $table->integer('dataFlag');
            $table->datetime('createTime');
            $table->integer('solve');
            $table->integer('unsolve');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
