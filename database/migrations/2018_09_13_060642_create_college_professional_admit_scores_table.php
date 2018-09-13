<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeProfessionalAdmitScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_professional_admit_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('college_id')->index();
            $table->integer('province_id')->index();
            $table->integer('year')->index()->default(0);
            $table->integer('professional_id')->index()->comment('专业名称');
            $table->integer('college_batch_id')->nullable()->comment('批次ID');
            $table->boolean('subject')->default(0)->comment('文科理科0:文科|1:理科');
            $table->integer('plan_number')->default(0)->comment('计划书');
            $table->integer('lowest_score')->default(0)->comment('最低分数');
            $table->integer('lowest_rank')->default(0)->comment('最低排名');
            $table->integer('lowest_line')->default(0)->comment('最低线差');
            $table->integer('average_score')->default(0)->comment('平均分数');
            $table->integer('average_rank')->default(0)->comment('平均排名');
            $table->integer('average_line')->default(0)->comment('平均线差');
            $table->string('advantage')->unllable()->comment('优势');
            $table->string('explain')->unllable()->comment('介绍');
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
        Schema::dropIfExists('college_professional_admit_scores');
    }
}
