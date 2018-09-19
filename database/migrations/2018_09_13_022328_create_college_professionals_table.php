<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeProfessionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_professionals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('college_professional_name', 100)->comment('专业名称');
            $table->Boolean('is_important')->default(1)->comment('是不是重点专业');
            $table->text('description')->nullable()->comment('介绍');
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
        Schema::dropIfExists('college_professionals');
    }
}
