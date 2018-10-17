<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorBachelorJuniorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('major_bachelor_juniors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bachelor_major_id')->comment('本科专业 ID');
            $table->integer('junior_major_id')->comment('专科专业 ID');
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
        Schema::dropIfExists('major_bachelor_juniors');
    }
}
