<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPlanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_plan_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->default(0)->index()->comment('属于哪个代理商ID,0:代表为自由学生,不从属代理商,后台也可以添加');
            $table->integer('student_id')->index()->comment('属于哪个学生ID');
            $table->integer('plan_category_id')->index()->default(0)->comment('计划方案类型');
            $table->integer('plane_id')->index();
            $table->integer('college_professional_admit_score_id')->comment('大学各专业录取分数 ID');
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
        Schema::dropIfExists('student_plan_details');
    }
}
