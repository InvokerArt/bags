<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banners = [
           [ 'title' => '首页轮播','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()], 
           [ 'title' => '招商加盟轮播','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
           [ 'title' => '展会轮播','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
           [ 'title' => '资讯轮播','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
        ];
        DB::table('banners')->insert($banners);
    }
}
