<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id')->unsigned()->default(0)->index();
            $table->string('title')->index();
            $table->string('image_url');
            $table->string('link')->nullable();
            $table->enum('target', ['_blank',  '_self'])->default('_blank')->index();
            $table->text('description')->nullable();
            $table->integer('order')->unsigned()->default(0)->index();
            $table->timestamp('published_from')->nullable()->index()->comment('轮播图时间开始');
            $table->timestamp('published_to')->nullable()->index()->comment('轮播图时间结束');
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
        Schema::dropIfExists('banner_image');
    }
}
