<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title')->index()->comment('供应标题');
            $table->string('slug')->nullable()->index()->comment('固定链接地址');
            $table->double('price', 10, 2)->comment('产品价格');
            $table->tinyInteger('unit')->default(1)->comment('价格单位 //1 个//2 袋//3 箱');
            $table->text('content')->comment('内容');
            $table->json('images')->comment('轮播图');
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
        Schema::dropIfExists('supplies');
    }
}
