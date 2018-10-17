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
            $table->string('username')->comment('用户名称');
            $table->string('serial_number')->comment('序列号');
            $table->string('mbti_name')->comment('测评类型名称');
            $table->string('mbti_category_id')->comment('mbti类型id');
            $table->string('mbti_e')->default('0')->comment('外向');
            $table->string('mbti_i')->default('0')->comment('内向');
            $table->string('mbti_s')->default('0')->comment('实感');
            $table->string('mbti_n')->default('0')->comment('直觉');
            $table->string('mbti_t')->default('0')->comment('思考');
            $table->string('mbti_f')->default('0')->comment('情感');
            $table->string('mbti_j')->default('0')->comment('判断');
            $table->string('mbti_p')->default('0')->comment('知觉');
            $table->string('holland_name')->comment('霍兰德测评名称');
            $table->string('holland_r')->default('0')->comment('现实型');
            $table->string('holland_i')->default('0')->comment('研究型');
            $table->string('holland_a')->default('0')->comment('艺术型');
            $table->string('holland_s')->default('0')->comment('社会型');
            $table->string('holland_e')->default('0')->comment('企业型');
            $table->string('holland_c')->default('0')->comment('传统型');
            $table->text('subject_scale')->comment('科目喜好比例');
            $table->text('answer')->comment('所有回答结果以及分析结果');
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
