<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashDrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_draws', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cashNo');
            $table->integer('targetType');
            $table->integer('targetId');
            $table->decimal('money',10);
            $table->integer('accType');
            $table->string('accTargetName',200);
            $table->string('accAreaName',200);
            $table->string('accNo',200);
            $table->string('accUser',200);
            $table->integer('cashSatus');
            $table->string('cashRemarks',500);
            $table->integer('cashConfigId');
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
        Schema::dropIfExists('cash_draws');
    }
}
