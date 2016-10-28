<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_companies = [
            ['lft'=>1,'rgt'=>2,'name'=>'垃圾袋','role'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>3,'rgt'=>4,'name'=>'背心袋','role'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>5,'rgt'=>6,'name'=>'连卷袋','role'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>7,'rgt'=>8,'name'=>'地膜','role'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>9,'rgt'=>10,'name'=>'阻隔膜','role'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>11,'rgt'=>12,'name'=>'快递袋','role'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>13,'rgt'=>14,'name'=>'边封袋','role'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>15,'rgt'=>16,'name'=>'其他','role'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>17,'rgt'=>18,'name'=>'垃圾袋','role'=>2,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>19,'rgt'=>20,'name'=>'背心袋','role'=>2,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>21,'rgt'=>22,'name'=>'连卷袋','role'=>2,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>23,'rgt'=>24,'name'=>'地膜','role'=>2,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>25,'rgt'=>26,'name'=>'阻隔膜','role'=>2,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>27,'rgt'=>28,'name'=>'快递袋','role'=>2,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>29,'rgt'=>30,'name'=>'边封袋','role'=>2,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>31,'rgt'=>32,'name'=>'其他','role'=>2,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>33,'rgt'=>34,'name'=>'环保塑料行业协会','role'=>3,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>35,'rgt'=>36,'name'=>'高分子协会','role'=>3,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>37,'rgt'=>38,'name'=>'政府机关','role'=>3,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['lft'=>39,'rgt'=>40,'name'=>'其他','role'=>3,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],

        ];

        DB::table('categories_companies')->insert($categories_companies);
    }
}
