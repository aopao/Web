<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('professional_id')->comment('专业 ID');
            $table->integer('clicks')->default(0)->comment('总点击');
            $table->string('awarded_degree')->nullable()->comment('毕业授予学位');
            $table->string('job_direction')->nullable()->comment('就业方向');
            $table->string('graduation_student_num')->default(0)->comment('毕业学生数');
            $table->string('work_rate')->default('0')->comment('就业率');
            $table->string('subject_art_rate')->default('0')->comment('文科比例');
            $table->string('subject_math_rate')->default('0')->comment('理科比例');
            $table->string('gender_male_rate')->default('0')->comment('男生比例');
            $table->string('gender_female_rate')->default('0')->comment('女生比例');
            $table->string('description')->nullable()->comment('简介');
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
        Schema::dropIfExists('professional_details');
    }
}
