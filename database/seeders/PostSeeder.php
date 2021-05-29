<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'post_title' => 'Laravel 8 is out! Be aware Developers',
            'post_status' => 'published',
            'category_id' => 1,
            'user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'post_image' => 'none',
            'post_details' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem.',
        ]);
    }
}
