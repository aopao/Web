<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbtiSeniorIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbti_senior_issues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('issue')->comment('问题');
            $table->string('iusse_category')->comment('测评分类');
            $table->string('dimension_category')->comment('维度值: MBTI测评统一为:M');
            $table->string('answer1_tip')->comment('答题1');
            $table->string('answer1_value')->comment('答题1值');
            $table->string('answer2_tip')->nullable()->comment('答题2');
            $table->string('answer2_value')->nullable()->comment('答题2值');
            $table->string('answer3_tip')->nullable()->comment('答题3');
            $table->string('answer3_value')->nullable()->comment('答题3值');
            $table->string('answer4_tip')->nullable()->comment('答题4');
            $table->string('answer4_value')->nullable()->comment('答题4值');
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
        Schema::dropIfExists('mbti_senior_issues');
    }
}
