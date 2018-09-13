<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeAdmitScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_admit_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('college_id')->index();
            $table->integer('province_id')->index()->comment('学校所在省份');
            $table->integer('local_province_id')->index()->default(0)->comment('录取省份');
            $table->integer('year')->nullable()->comment('批次名称');
            $table->integer('subject')->default(0)->comment('文科理科0:文科|1:理科');
            $table->integer('college_batch_id')->default(0)->comment('计划批次ID');
            $table->integer('min_score')->default(0)->comment('最低分');
            $table->integer('average_score')->default(0)->comment('平均分');
            $table->integer('max_score')->default(0)->comment('最高分');
            $table->integer('admit_num')->default(0)->comment('录取人数');
            $table->integer('score_poor')->default(0)->comment('分数线差');
            $table->integer('province_score')->default(0)->comment('录取省份的录取分数线');
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
        Schema::dropIfExists('college_admit_scores');
    }
}
