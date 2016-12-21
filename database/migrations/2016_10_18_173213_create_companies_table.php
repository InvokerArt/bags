<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->index()->comment('公司名');
            $table->string('slug')->nullable()->unique()->index()->comment('固定链接地址');
            $table->string('telephone', 30)->comment('公司电话');
            $table->json('licenses')->nullable()->comment('营业执照');
            $table->json('photos')->nullable()->comment('公司照片');
            $table->text('notes')->comment('加盟须知');
            $table->text('content')->comment('公司简介');
            $table->integer('address')->comment('公司地址ID');
            $table->string('addressDetail')->comment('公司详细地址');
            $table->integer('view_count')->unsigned()->default(0)->index()->comment('浏览数');
            $table->integer('comment_count')->unsigned()->default(0)->index()->comment('评论数');
            $table->tinyInteger('role')->default(1)->comment('用户身份 1采购商 2供应商 3机构/单位');
            $table->enum('is_excellent', ['yes',  'no'])->default('no')->index()->comment('是否推广');
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
        Schema::dropIfExists('companys');
    }
}
