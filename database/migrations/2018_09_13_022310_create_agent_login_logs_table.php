<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_login_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->comment('代理商 ID');
            $table->string('ip', 15);
            $table->string('address', 200)->comment('登陆地点');
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
        Schema::dropIfExists('agent_login_logs');
    }
}
