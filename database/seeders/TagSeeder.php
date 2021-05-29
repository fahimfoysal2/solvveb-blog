<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            ['tag_name' => 'mobile', 'tag_status' => 'paused'],
            ['tag_name' => 'eloquent', 'tag_status' => 'active'],
            ['tag_name' => 'free service', 'tag_status' => 'active'],
            ['tag_name' => 'linux', 'tag_status' => 'active'],
        ]);
    }
}
