<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->default(0)->index()->comment('属于哪个代理商ID,0:代表为自由学生,不从属代理商,后台也可以添加');
            $table->integer('student_id')->index()->comment('属于哪个学生ID');
            $table->integer('plan_category_id')->index()->default(0)->comment('计划方案类型');
            $table->string('plan_name', 200);
            $table->string('plan_number', 50)->index()->default(0)->comment('计划序号');
            $table->string('plan_query')->default(0)->comment('方案查询条件');
            $table->boolean('is_save')->default(0)->comment('0:暂存,1:保存');
            $table->boolean('is_close')->default(0)->comment('0:不关闭,1:关闭,后台管理员设置');
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
        Schema::dropIfExists('student_plans');
    }
}
