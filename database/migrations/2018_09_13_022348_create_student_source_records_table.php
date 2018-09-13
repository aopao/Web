<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSourceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_score_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->index()->comment('属于哪个学生ID');
            $table->integer('school_exam_category_id')->comment('考试类型');
            $table->integer('school_grade_id')->comment('考试年级');
            $table->string('score',10)->default('0')->comment('考试分数');
            $table->integer('rank')->default(0)->comment('考试排名');
            $table->string('chinese',10)->default('0')->comment('语文考试分数');
            $table->string('math',10)->default('0')->comment('数学考试分数');
            $table->string('english',10)->default('0')->comment('英语考试分数');
            $table->string('physics',10)->default('0')->comment('物理考试分数');
            $table->string('chemistry',10)->default('0')->comment('化学考试分数');
            $table->string('biology',10)->default('0')->comment('生物考试分数');
            $table->string('geography',10)->default('0')->comment('地理考试分数');
            $table->string('science_comprehensive',10)->default('0')->comment('理综考试分数');
            $table->string('arts_comprehensive',10)->default('0')->comment('文综考试分数');
            $table->string('note')->comment('备注');
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
        Schema::dropIfExists('student_score_records');
    }
}
