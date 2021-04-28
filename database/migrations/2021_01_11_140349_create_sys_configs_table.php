<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fieldName',20);
            $table->string('fieldCode',100);
            $table->string('fieldValue',100);
            $table->integer('fieldType');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_configs');
    }
}
