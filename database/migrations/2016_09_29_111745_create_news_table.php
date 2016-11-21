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
            $table->string('slug')->nullable()->index()->comment('固定链接地址');
            $table->string('title')->index()->comment('标题');
            $table->string('subtitle')->comment('副标题');
            $table->text('content')->comment('内容');
            $table->string('image')->default('')->comment('标题图片');
            $table->integer('view_count')->unsigned()->default(0)->index()->comment('浏览数');
            $table->integer('comment_count')->unsigned()->default(0)->index()->comment('评论数');
            $table->enum('is_excellent', ['yes',  'no'])->default('no')->index()->comment('是否推广');
            $table->enum('is_top', ['yes',  'no'])->default('no')->index()->comment('是否置顶');
            $table->tinyInteger('status')->default(1)->comment('状态//0回收站//1已发布//2未来发布');
            $table->timestamp('published_at')->nullable()->index()->comment('发布于');
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
        Schema::drop('news');
    }
}
