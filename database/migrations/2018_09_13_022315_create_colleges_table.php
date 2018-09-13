<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('college_name', 100)->index();
            $table->string('college_english_name', 200)->unllable()->comment('学校英文名称');
            $table->integer('college_rank')->comment('学校排名');
            $table->integer('province_id')->index();
            $table->integer('city_id')->unllable()->index();
            $table->integer('college_level_id')->unllable()->index()->comment('层次|eg:本科/大专');
            $table->integer('college_category_id')->unllable()->index()->comment('科类|eg:工科类');
            $table->boolean('is_belong_to_edu')->default(0)->comment('是否从属教育部');
            $table->boolean('is_belong_to_center')->default(0)->comment('是否从属中央');
            $table->boolean('is_nation')->default(0)->comment('是否是公办');
            $table->boolean('is_985')->default(0)->comment('是否是985');
            $table->boolean('is_211')->default(0)->comment('是否是211');
            $table->boolean('is_top_college')->default(0)->comment('是否是一流大学');
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
        Schema::dropIfExists('colleges');
    }
}
