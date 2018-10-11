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
            $table->string('representative_person')->comment('代表人物');
            $table->string('representative_avatar')->comment('代表人物头像');
            $table->text('representative_quotations')->comment('代表人物语录');
            $table->text('personality_traits')->comment('人格特征');
            $table->text('personality_advantage')->comment('人格闪光点');
            $table->text('personality_disadvantage')->comment('人格盲点');
            $table->text('temperament_lead')->comment('气质导语');
            $table->text('temperament_category')->comment('气质分类');
            $table->text('temperament_overview')->comment('气质概述');
            $table->text('temperament_introduce')->comment('气质介绍');
            $table->text('temperament_negative')->comment('气质负面');
            $table->text('brief_description')->comment('基本描述');
            $table->text('advice')->comment('建议');
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
