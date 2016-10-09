<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('slug')->unique()->index()->comment('固定链接地址');
            $table->string('title')->comment('标题');
            $table->string('subtitle')->comment('副标题');
            $table->text('content')->comment('内容');
            $table->string('image')->nullable()->comment('标题图片');
            $table->integer('hits')->default(0)->comment('浏览数');
            $table->integer('comments')->default(0)->comment('评论数');
            $table->tinyInteger('status')->default(1)->comment('状态//0回收站//1已发布//2未来发布');
            $table->timestamp('published_at')->index()->comment('发布于');
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
        Schema::drop('news');
    }
}
