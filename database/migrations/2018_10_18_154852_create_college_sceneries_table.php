<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeSceneriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_sceneries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('college_id');
            $table->string('name')->default(null)->comment('美景名称');
            $table->string('pic')->comment('大学图片');
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
        Schema::dropIfExists('college_sceneries');
    }
}
