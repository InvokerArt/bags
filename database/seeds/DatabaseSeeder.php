<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //权限
        $this->call(AccessTableSeeder::class);
        //地区
        $this->call(AreasTableSeeder::class);
        //分类
        $this->call(CategoriesTableSeeder::class);

        Model::reguard();
    }
}
