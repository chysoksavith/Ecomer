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
                'name' => 'Amit',
                'type' => 'subadmin',
                'mobile' => 32342342,
                'email' => 'amit@gmail.com',
                'password' => $password,
                'image' => '',
                'status' => 1
            ],
        ];
        Admin::insert($adminRecords);
    }
}
