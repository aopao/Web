<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbtiCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbti_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mbti_short_code')->comment('mbti类型短名称');
            $table->text('mbti_name')->comment('mbti类型名称');
            $table->string('mbti_english_name')->comment('mbti英文名称');
            $table->text('advantage_and_disadvantage')->comment('优势与劣势');
            $table->text('temperament_type')->comment('气质类型');
            $table->text('brief_description')->comment('基本介绍');
            $table->string('representative_person')->comment('代表人物');
            $table->string('representative_avatar')->comment('代表人物头像');
            $table->text('representative_quotations')->comment('代表人物语录');
            $table->text('afterword')->comment('后记');
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
        Schema::dropIfExists('mbti_categories');
    }
}
