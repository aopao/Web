<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminOperatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_operates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->comment('管理员 ID');
            $table->string('path', 100)->comment('操作的路由');
            $table->string('method', 20)->commet('操作方式');
            $table->string('ip', 15);
            $table->string('sql')->commet('操作的 SQL 语句');
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
        Schema::dropIfExists('admin_operates');
    }
}
