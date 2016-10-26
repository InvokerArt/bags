<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title')->index()->comment('需求标题');
            $table->string('slug')->nullable()->index()->comment('固定链接地址');
            $table->integer('quantity')->unsigned()->comment('产品数量');
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
        Schema::dropIfExists('demands');
    }
}
