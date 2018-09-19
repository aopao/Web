<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('后台 name 名称');
            $table->string('value')->nullable();
            $table->string('display_name')->nullable()->comment('后台 显示 名称');
            $table->string('description')->nullable();
            $table->timestamps();
        });
        $data = [
            ['name' => 'web_name', 'value' => '黑马高考', 'display_name' => '网站名称'],
            ['name' => 'copyright', 'value' => '黑马高考版权', 'display_name' => '网站版权'],
            ['name' => 'login_message', 'value' => '黑马高考登录界面信息', 'display_name' => '界面信息'],
            ['name' => 'web_url', 'value' => '黑马高考URL', 'display_name' => 'URL'],
            ['name' => 'seo_index', 'value' => '黑马高考首页标题', 'display_name' => '首页标题'],
            ['name' => 'seo_keywords', 'value' => '黑马高考关键字', 'display_name' => '关键字'],
            ['name' => 'seo_description', 'value' => '黑马高考描述', 'display_name' => '描述'],
            ['name' => 'analyze_code', 'value' => '黑马高考统计代码', 'display_name' => '统计代码'],
        ];
        DB::table('configs')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
