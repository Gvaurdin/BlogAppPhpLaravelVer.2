<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++)
        {
            $postID = rand(1, 10);
            $categoryID = rand(1, 5);
            if(!DB::table('categories_posts')
                ->where('post_id', $postID)
                ->where('category_id', $categoryID)
                ->exists())
            {
                DB::table('categories_posts')->insertOrIgnore([
                    'post_id' => rand(1, 10),
                    'category_id' => rand(1, 5),
                ]);
            }
        }
    }
}
