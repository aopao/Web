<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHollandProfessionalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holland_professional_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('维度名');
            $table->string('jobs')->comment('就业方向');
            $table->string('majors')->comment('专业方向');
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
        Schema::dropIfExists('holland_professional_codes');
    }
}
