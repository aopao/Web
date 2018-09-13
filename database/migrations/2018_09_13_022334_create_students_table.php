<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile', 11)->index()->unique()->comment('也可用手机号登录,可不用');
            $table->string('password');
            $table->string('nickname', 100)->nullable();
            $table->string('last_login_ip', 15)->nullable();
            $table->string('last_login_time', 20)->nullable();
            $table->boolean('status')->default(1)->comment('账户状态0:禁封,1:正常');
            $table->string('verify_token', 128)->nullable()->comment('邮箱验证Token');
            $table->integer('plan_number')->default(0)->comment('学生总计数数');
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
        Schema::dropIfExists('students');
    }
}
