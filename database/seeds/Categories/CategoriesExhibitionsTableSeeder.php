<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesExhibitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_exhibitions = [
            ['lft'=>1,'rgt'=>2,'name'=>'原料','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>3,'rgt'=>4,'name'=>'设备','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>5,'rgt'=>6,'name'=>'成品','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>7,'rgt'=>8,'name'=>'添加剂','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>9,'rgt'=>10,'name'=>'检测','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>11,'rgt'=>12,'name'=>'其他','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
        ];

        DB::table('categories_exhibitions')->insert($categories_exhibitions);
    }
}
