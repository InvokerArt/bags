<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesTopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_topics = [
            ['lft'=>1,'rgt'=>2,'name'=>'专业知识','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>3,'rgt'=>4,'name'=>'活动交友','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>5,'rgt'=>6,'name'=>'新闻资讯','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>7,'rgt'=>8,'name'=>'商务合作','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>9,'rgt'=>10,'name'=>'财经金融','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>11,'rgt'=>12,'name'=>'反馈建议','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
        ];

        DB::table('categories_topics')->insert($categories_topics);
    }
}
