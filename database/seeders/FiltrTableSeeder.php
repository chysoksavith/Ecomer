<?php

namespace Database\Seeders;

use App\Models\ProductsFilter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiltrTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filterRecords = [
            [
                'id' => 1,
                'filter_name' => 'Fabric',
                'filter_value' => 'Cotton',
                'sort' => 1,
                'status' => 1
            ],
            [
                'id' => 2,
                'filter_name' => 'Fabric',
                'filter_value' => 'Polyester',
                'sort' => 2,
                'status' => 1
            ],
            [
                'id' => 3,
                'filter_name' => 'Fabric',
                'filter_value' => 'Wool',
                'sort' => 3,
                'status' => 1
            ],
            // Sleeve
            [
                'id' => 4,
                'filter_name' => 'Sleeve',
                'filter_value' => 'Full Sleeve',
                'sort' => 1,
                'status' => 1
            ],
            [
                'id' => 5,
                'filter_name' => 'Sleeve',
                'filter_value' => 'Half Sleeve',
                'sort' => 2,
                'status' => 1
            ],
            [
                'id' => 6,
                'filter_name' => 'Sleeve',
                'filter_value' => 'Short Sleeve',
                'sort' => 3,
                'status' => 1
            ],
            // Pattern
            [
                'id' => 7,
                'filter_name' => 'Pattern',
                'filter_value' => 'Checked',
                'sort' => 1,
                'status' => 1
            ],
            [
                'id' => 8,
                'filter_name' => 'Pattern',
                'filter_value' => 'Plain',
                'sort' => 2,
                'status' => 1
            ],
            [
                'id' => 9,
                'filter_name' => 'Pattern',
                'filter_value' => 'Printed',
                'sort' => 3,
                'status' => 1
            ],
            [
                'id' => 10,
                'filter_name' => 'Pattern',
                'filter_value' => 'Self',
                'sort' => 4,
                'status' => 1
            ],
            [
                'id' => 11,
                'filter_name' => 'Pattern',
                'filter_value' => 'Solid',
                'sort' => 5,
                'status' => 1
            ],
            // Fit
            [
                'id' => 12,
                'filter_name' => 'Fit',
                'filter_value' => 'Regular',
                'sort' => 1,
                'status' => 1
            ],
            [
                'id' => 13,
                'filter_name' => 'Fit',
                'filter_value' => 'Slim',
                'sort' => 2,
                'status' => 1
            ],
            [
                'id' => 14,
                'filter_name' => 'Fit',
                'filter_value' => 'OverSize',
                'sort' => 3,
                'status' => 1
            ],
            // Occasion
            [
                'id' => 15,
                'filter_name' => 'Occasion',
                'filter_value' => 'Casual',
                'sort' => 1,
                'status' => 1
            ],
            [
                'id' => 16,
                'filter_name' => 'Occasion',
                'filter_value' => 'Formal',
                'sort' => 2,
                'status' => 1
            ]
        ];
        ProductsFilter::insert($filterRecords);
    }
}
