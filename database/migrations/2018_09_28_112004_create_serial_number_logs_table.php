<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerialNumberLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serial_number_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serial_number_id')->default(0)->index()->comment('序列号ID');
            $table->string('mobile')->default(0)->index()->comment('测试手机号');
            $table->integer('agent_id')->default(0)->index()->comment('哪个代理商使用');
            $table->integer('student_id')->default(0)->index()->comment('哪个学生使用');
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
        Schema::dropIfExists('serial_number_logs');
    }
}
