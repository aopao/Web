<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_login_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admin_mobile', 20)->comment('管理员 ID');
            $table->string('ip', 15)->nullable();
            $table->string('platform', 200)->nullable()->comment('登录平台PC|Mobile');
            $table->string('device', 200)->nullable()->comment('使用是安卓还是 IOS');
            $table->string('browser')->nullable()->comment('使用的浏览器');
            $table->string('address', 200)->nullable()->comment('登陆地点');
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
        Schema::dropIfExists('admin_login_logs');
    }
}
