<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->comment('学员 ID');
            $table->boolean('subject')->default(0)->comment('默认为0:文科,1:理科');
            $table->integer('school_id')->nullable()->comment('高中学校');
            $table->integer('exam_address_province_id')->nullable()->comment('高考考试省份');
            $table->string('id_card')->nullable()->comment('身份证');
            $table->string('contact', 100)->nullable()->comment('联系人名称');
            $table->string('mobile', 11)->nullable()->comment('联系人手机');
            $table->integer('province_id')->default(0)->index()->comment('户籍省份');
            $table->integer('city_id')->nullable()->comment('户籍市区');
            $table->integer('area_id')->nullable()->comment('户籍地域');
            $table->string('nation')->nullable()->comment('民族');
            $table->string('avatar')->nullable();
            $table->string('email')->nullable();
            $table->integer('qq')->nullable();
            $table->string('intention_major')->nullable()->comment('意向专业');
            $table->string('intention_college')->nullable()->comment('意向院校地区');
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
        Schema::dropIfExists('student_details');
    }
}
