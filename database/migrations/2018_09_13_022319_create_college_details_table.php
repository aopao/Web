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
            $table->string('web', 100)->nullable()->comment('学校官网');
            $table->string('full_view', 100)->nullable()->comment('全景');
            $table->string('telephone', 100)->unllable()->comment('联系电话');
            $table->string('membership', 255)->unllable()->comment('所属部门');
            $table->string('email')->unllable()->comment('Email');
            $table->string('address', 100)->unllable()->comment('联系地址');
            $table->string('old_college_name', 100)->nullable()->comment('曾用名');
            $table->text('description')->nullable()->comment('简介');
            $table->text('charge_standard')->nullable()->comment('收费标准');
            $table->text('job_prospect')->nullable()->comment('就业前景');
            $table->string('male_rate', 20)->nullable()->comment('男生比例');
            $table->string('female_rate', 20)->nullable()->comment('女生比例');

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
        Schema::dropIfExists('college_details');
    }
}
