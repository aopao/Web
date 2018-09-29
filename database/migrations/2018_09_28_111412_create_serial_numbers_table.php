<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerialNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serial_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 50)->unique()->index();
            $table->boolean('is_senior')->default(0)->comment('0:初级,1:高级,默认生成初级序列号');
            $table->boolean('is_invalid')->default(0)->comment('0: 未使用,1:已使用,默认生成未使用序列号');
            $table->integer('parent')->default(0)->comment('0:如果是高级序列号可分裂成初级序列号,记录高级序列号ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serial_numbers');
    }
}
