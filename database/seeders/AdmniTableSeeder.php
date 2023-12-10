<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdmniTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456');
        $adminRecords = [
            [
                'id' => 1,
                'name' => 'Admin',
                'type' => 'admin',
                'mobile' => 9999999,
                'email' => 'admin@gmail.com',
                'password' => $password,
                'image' => '',
                'status' => 1
            ],
            [
                'id' => 2,
                'name' => 'Admin1',
                'type' => 'admin',
                'mobile' => 9999999,
                'email' => 'admin1@gmail.com',
                'password' => $password,
                'image' => '',
                'status' => 1
            ],
            [
                'id' => 3,
                'name' => 'Admin2',
                'type' => 'admin',
                'mobile' => 9999999,
                'email' => 'admin2@gmail.com',
                'password' => $password,
                'image' => '',
                'status' => 1
            ],
        ];
        Admin::insert($adminRecords);
    }
}
