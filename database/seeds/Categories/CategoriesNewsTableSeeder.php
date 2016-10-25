<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesNewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_news = [
            ['lft'=>1,'rgt'=>2,'name'=>'可降解知识','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>3,'rgt'=>4,'name'=>'高分子知识','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>5,'rgt'=>6,'name'=>'国内市场动态','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>7,'rgt'=>8,'name'=>'国外市场动态','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>9,'rgt'=>10,'name'=>'行业新闻','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>11,'rgt'=>12,'name'=>'法律法规','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
        ];

        DB::table('categories_news')->insert($categories_news);
    }
}
