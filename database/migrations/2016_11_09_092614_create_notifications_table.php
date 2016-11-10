<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['system',  'user'])->default('user')->index()->comment('消息的类型');
            $table->morphs('notification');
            $table->text('data')->nullable()->comment('消息的内容');
            $table->string('action')->index()->nullable()->comment('提醒信息的动作类型');
            $table->integer('sender')->index()->nullable()->comment('发送者的ID');
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
        Schema::dropIfExists('notifications');
    }
}
