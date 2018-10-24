<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerialNumberRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serial_number_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serial_number_id')->default(0)->index()->comment('序列号ID');
            $table->string('serial_number')->default(0)->index()->comment('序列号');
            $table->string('mobile')->default(0)->index()->comment('测试手机号');
            $table->string('username')->default(0)->comment('测试手机号');
            $table->string('assessment_type')->default(0)->comment('测试类型');
            $table->text('answers')->comment('作答记录');
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
        Schema::dropIfExists('serial_number_records');
    }
}
