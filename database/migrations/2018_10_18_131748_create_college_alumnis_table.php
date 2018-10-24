<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_alumnis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('college_id');
            $table->string('name')->default(null)->comment('校友名称');
            $table->string('position')->comment('身份');
            $table->string('avatar')->comment('头像');
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
        Schema::dropIfExists('college_alumnis');
    }
}
