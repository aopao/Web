<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 管理员表
         */
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile', 11)->index()->unique();
            $table->string('password');
            $table->string('nickname', 100)->nullable();
            $table->string('avatar')->nullable();
            $table->string('email', 100)->nullable();
            $table->integer('qq')->nullable();
            $table->boolean('status')->default(1)->comment('账户状态0:禁封,1:正常');
            $table->string('verify_token', 128)->nullable()->comment('邮箱验证Token');
            $table->boolean('email_is_active')->default(0)->comment('邮箱是否已经验证,默认不认证');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
