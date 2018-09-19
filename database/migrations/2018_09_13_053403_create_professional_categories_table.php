<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('professional_category_name', 100)->comment('根分类名称');
            $table->string('professional_category_code')->comment('根分类ID');
            $table->integer('parent_id')->comment('父类 ID');
            $table->string('description')->nullable()->comment('简介');
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
        Schema::dropIfExists('professional_categories');
    }
}
