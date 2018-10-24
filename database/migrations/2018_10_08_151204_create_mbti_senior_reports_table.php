<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbtiSeniorReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbti_senior_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile')->comment('用户手机号');
            $table->string('serial_number')->comment('序列号');
            $table->string('mbti_name')->comment('测评类型名称');
            $table->string('mbti_category_id')->comment('mbti类型id');
            $table->string('e')->default('0')->comment('外向');
            $table->string('i')->default('0')->comment('内向');
            $table->string('s')->default('0')->comment('实感');
            $table->string('n')->default('0')->comment('直觉');
            $table->string('t')->default('0')->comment('思考');
            $table->string('f')->default('0')->comment('情感');
            $table->string('j')->default('0')->comment('判断');
            $table->string('p')->default('0')->comment('知觉');
            $table->string('answer')->default('0')->comment('回答结果');
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
        Schema::dropIfExists('mbti_senior_reports');
    }
}
