<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinceControlScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('province_control_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id')->index();
            $table->integer('year')->default(0)->index();
            $table->string('batch')->nullable();
            $table->integer('subject')->default(0);
            $table->integer('score')->default(0);
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
        Schema::dropIfExists('province_control_scores');
    }
}
