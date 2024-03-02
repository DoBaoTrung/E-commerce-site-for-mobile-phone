<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            0 => [
                'color_name' => 'Xanh dương',
            ],
            1 => [
                'color_name' => 'Đỏ',
            ],
            2 => [
                'color_name' => 'Vàng',
            ],
            3 => [
                'color_name' => 'Tím',
            ],
            4 => [
                'color_name' => 'Hồng',
            ],
            5 => [
                'color_name' => 'Đen',
            ],
            6 => [
                'color_name' => 'Trắng',
            ],
            7 => [
                'color_name' => 'Xám',
            ],
            8 => [
                'color_name' => 'Vani',
            ],
            9 => [
                'color_name' => 'Xanh lá',
            ]
        ];

        foreach ($data as $color) {
            Color::create($color);
        }
    }
}
        