<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCollegeFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_college_favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->index()->comment('属于哪个学生ID');
            $table->integer('college_id')->index()->default(0)->comment('大学ID');
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
        Schema::dropIfExists('student_college_favorites');
    }
}
