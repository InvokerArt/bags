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
            $table->string('username')->index()->default('')->comment('用户名');
            $table->string('name', 30)->default('')->comment('真实姓名');
            $table->string('mobile', 30)->index()->unique()->comment('手机号');
            $table->string('email')->index()->default('')->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->string('avatar')->default('')->comment('头像');
            $table->rememberToken();
            $table->string('source')->nullable()->index(); // 来源跟踪：iOS，Android
            $table->integer('topic_count')->default(0)->index();
            $table->integer('reply_count')->default(0)->index();
            $table->integer('follower_count')->default(0)->index();
            $table->enum('email_notify_enabled', ['yes',  'no'])->default('yes')->index();
            $table->enum('is_banned', ['yes',  'no'])->default('no')->index();
            $table->timestamp('last_actived_at')->nullable();
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
