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
            $table->string('answer1')->comment('答题1');
            $table->string('answer2')->comment('答题2');
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
