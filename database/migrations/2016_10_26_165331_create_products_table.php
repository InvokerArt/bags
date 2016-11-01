<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title')->index()->comment('产品标题');
            $table->string('slug')->nullable()->index()->comment('固定链接地址');
            $table->double('price', 10, 2)->comment('产品价格');
            $table->tinyInteger('unit')->default(1)->comment('价格单位 //1 只 //2 个 //3 扎 //4 袋 //5 箱');
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
        Schema::dropIfExists('products');
    }
}
