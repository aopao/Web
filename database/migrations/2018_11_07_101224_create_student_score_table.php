<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_score', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_exam_category_id')->comment('考试类型');
            $table->string('school_grade_id')->comment('考试年级');
            $table->string('score', 10)->default('0')->comment('考试分数');
            $table->string('rank')->default(0)->comment('考试排名');
            $table->text('note')->nullable()->comment('备注');
            $table->text('ratio')->nullable()->comment('各科比例');
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
        Schema::dropIfExists('student_score');
    }
}
