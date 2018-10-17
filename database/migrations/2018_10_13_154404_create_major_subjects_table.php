<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('major_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('major_id')->comment('专业ID');
            $table->integer('subject')->comment('科类');
            $table->integer('diplomas')->comment('文凭层次');
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
        Schema::dropIfExists('major_subjects');
    }
}
