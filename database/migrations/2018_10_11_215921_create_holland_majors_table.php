<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHollandMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holland_majors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('职业代码');
            $table->string('mbti')->comment('性格值');
            $table->integer('major_id')->comment('专业ID');
            $table->integer('diplomas')->comment('专业层次');
            $table->integer('subject')->comment('所属科目');
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
        Schema::dropIfExists('holland_majors');
    }
}
