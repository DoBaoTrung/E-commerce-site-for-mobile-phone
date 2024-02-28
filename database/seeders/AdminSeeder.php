<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            0 => [
                'name' => 'Super Admin',
                'email' => 'sadmin@gmail.com',
                // 'avatar' => '',
                'password' => bcrypt('1234'),
                'role_id' => 1
            ],
            1 => [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                // 'avatar' => '',
                'password' => bcrypt('1234'),
                'role_id' => 2
            ]
        ];

        foreach ($data as $key => $value) {
            Admin::create($value);
        }
    }
}
