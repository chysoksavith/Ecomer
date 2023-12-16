<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productRecords = [
            'category_id' => 8,
            'brand_id' => 0,
            'product_name' => 'Blue T-shirt',
            'product_color' => 'Dark Blue',
            'family_color' => 'Blue',
            'group_code' => 'TSHIRT0000',
            'product_price' => 1500,
            'product_price' => '10',
            'discount_type' => 'product',
            'final_price' => 133,
            'product_weight' => 500,
            'product_video' => '',
            'description' => 'test',
            'wash_care' => '',
            'Keywords' => '',
            'fabric' => '',
            'pattern' => '',
            'sleeve' => '',
            'fit' => '',
            'occassion' => '',
            'meta_title' => '',
            'meta_description' => '',
            'meta_Keywords' => '',
            'is_featured' => 'Yes',
            'status' => 1,
        ];
        Product::insert($productRecords);
    }
}
