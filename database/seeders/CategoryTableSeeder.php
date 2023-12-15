<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryRecord = [
            'parent_id' => 1,
            'category_name' => 'men',
            'category_image' => '',
            'category_discount' => 0,
            'description' => '',
            'url' => 'clothing',
            'meta_title' => '',
            'meta_description' => '',
            'meta_Keywords' => '',
            'status' => 1,
        ];
        Category::insert($categoryRecord);
    }
}
