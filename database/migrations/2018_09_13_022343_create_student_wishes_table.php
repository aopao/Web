<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentWishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_wishes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->index()->comment('属于哪个学生ID');
            $table->integer('wish_category')->default(1)->comment('1:第一2:第二3:第三志愿,只能有3个');
            $table->integer('college_id')->index()->default(0)->comment('大学ID');
            $table->integer('college_professional_id')->default(0)->comment('大学专业 ID');
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
        Schema::dropIfExists('student_wishes');
    }
}
