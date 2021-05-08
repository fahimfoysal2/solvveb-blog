<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Super Admin",
            'email' => "admin@admin.com",
            'password' => bcrypt("12345678"),
            'user_type' => "admin",
        ]);

        DB::table('users')->insert([
            'name' => "Touhid",
            'email' => "touhid@usesr.com",
            'password' => bcrypt("12345678"),
            'user_type' => "guest",
        ]);
    }
}
