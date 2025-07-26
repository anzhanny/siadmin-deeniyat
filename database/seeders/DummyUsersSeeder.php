<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $userData = [
            [
                'name' => 'Admin Deeniyat',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('12345678'),
                'is_active' => 1
            ],
            [
                'name' => 'Student Deeniyat',
                'email' => 'student@gmail.com',
                'role' => 'student',
                'password' => bcrypt('12345678'),
                'is_active' => 1
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }

    }
}
