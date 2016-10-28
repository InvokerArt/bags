<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::table('users')->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM ' . 'users');
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . 'users' . ' CASCADE');
        }

        //Add the master administrator, user id of 1
        $users = [
            [
                'username'              => 'admin',
                'mobile'             => '13111111111',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt('admin123'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'username'              => 'user',
                'mobile'             => '13113113111',
                'email'             => 'user@user.com',
                'password'          => bcrypt('user123'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($users);

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
