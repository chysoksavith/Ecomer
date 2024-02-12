<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class couponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $couponRecord = [
            'coupon_options' => 'Manual',
            'coupon_code' => 'test10',
            'categories' => '15,16,17,18,19',
            'brands' => '5,6',
            'users' => '',
            'coupon_type' => 'Single',
            'amount_type' => 'Percentage',
            'amount' => '10',
            'expiry_date' => '2024-01-29',
            'status' => 1
        ];
        Coupon::insert($couponRecord);
    }
}
