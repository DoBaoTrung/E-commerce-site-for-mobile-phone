<?php

namespace Database\Seeders;

use App\Models\StorageCapacity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorageCapacitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            0 => [
                'capacity' => '64GB'
            ],
            1 => [
                'capacity' => '128GB'
            ],
            2 => [
                'capacity' => '256GB'
            ],
            3 => [
                'capacity' => '512GB'
            ],
            4 => [
                'capacity' => '1TB'
            ]
        ];

        foreach ($data as $capacity) {
            StorageCapacity::create($capacity);
        }
    }
}
