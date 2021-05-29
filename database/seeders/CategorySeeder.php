<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => 'Technology', 'category_status' => 'paused'],
            ['category_name' => 'Operating System', 'category_status' => 'active'],
            ['category_name' => 'Laravel', 'category_status' => 'active'],
            ['category_name' => 'Blogging', 'category_status' => 'active'],
            ['category_name' => 'Freelance', 'category_status' => 'paused'],
            ['category_name' => 'Tutorial', 'category_status' => 'active'],
        ]);
    }
}
