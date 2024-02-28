<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            0 => [
                'name' => 'Super Admin'
            ],
            1 => [
                'name' => 'Admin'
            ],
            2 => [
                'name' => 'User'
            ],
        ];

        foreach ($data as $role) {
            Role::create($role);
        }
    }
}
