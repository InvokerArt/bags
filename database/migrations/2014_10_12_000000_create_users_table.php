<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->nullable()->comment('用户名');
            $table->string('mobile', 30)->unique()->comment('手机号');
            $table->string('email')->unique()->nullable()->comment('邮箱');
            $table->string('password')->nullable()->comment('密码');
            $table->string('avatar')->nullable()->comment('头像');
            $table->rememberToken();
            $table->tinyInteger('status')->default(1)->comment('用户状态 0禁用');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
