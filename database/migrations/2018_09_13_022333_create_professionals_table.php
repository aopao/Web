<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('professional_name', 50)->comment('分类名称');
            $table->string('professional_code', 20)->comment('分类ID');
            $table->integer('parent_id')->comment('上级分类 ID');
            $table->integer('top_parent_id')->comment('根分类 ID');
            $table->integer('professional_level')->default(0)->comment('专业层次0:专科|1:本科');
            $table->integer('ranking')->comment('排名');
            $table->integer('ranking_type')->comment('同专业内排名');
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
        Schema::dropIfExists('majors');
    }
}
