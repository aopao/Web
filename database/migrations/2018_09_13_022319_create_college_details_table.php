<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('college_id')->comment('大学 ID');
            $table->string('college_code', 20)->nullable()->comment('院校国家标码ID');
            $table->integer('since')->nullable()->comment('建校时间');
            $table->string('web', 100)->nullable()->comment('学校官网');
            $table->string('full_view', 100)->nullable()->comment('全景');
            $table->integer('doctor_number')->default(0)->comment('博士数');
            $table->integer('postgraduate_number')->default(0)->comment('研究生数');
            $table->string('membership', 100)->nullable()->comment('隶属部门');
            $table->string('telephone', 100)->unllable()->comment('联系电话');
            $table->string('email')->unllable()->comment('Email');
            $table->integer('all_clicks')->default(0)->comment('总点击数');
            $table->integer('month_clicks')->default(0)->comment('月点击数');
            $table->integer('week_clicks')->default(0)->comment('周点击数');
            $table->string('student_rank', 10)->default(0)->comment('学习指数');
            $table->string('life_rank', 10)->default(0)->comment('生活指数');
            $table->string('work_rank', 10)->default(0)->comment('工作指数');
            $table->string('address', 100)->unllable()->comment('联系地址');
            $table->string('old_college_name', 100)->nullable()->comment('曾用名');
            $table->text('description')->nullable()->comment('简介');
            $table->text('charge_standard')->nullable()->comment('收费标准');
            $table->text('job_prospect')->nullable()->comment('就业前景');
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
        Schema::dropIfExists('college_detials');
    }
}
