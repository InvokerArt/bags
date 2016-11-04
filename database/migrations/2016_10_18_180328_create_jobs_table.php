<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('job', 30)->comment('招聘职位');
            $table->string('total', 20)->comment('招聘人数');
            $table->string('education', 20)->comment('学历要求');
            $table->string('experience', 20)->comment('工作年限');
            $table->string('minsalary', 20)->comment('待遇薪资');
            $table->text('content')->comment('其他');
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
        Schema::dropIfExists('company_content');
    }
}
