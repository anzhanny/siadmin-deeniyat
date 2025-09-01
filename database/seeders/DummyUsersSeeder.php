<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyUsersSeeder extends Seeder
{
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin Deeniyat',
                'email' => 'admin@gmail.com',
                'role_id' => 1, // Admin
                'password' => Hash::make('deeniyat123'),
                'is_active' => 1
            ],
            [
                'name' => 'Student Dummy',
                'email' => 'student@gmail.com',
                'role_id' => 2, // Student
                'password' => Hash::make('student123'),
                'is_active' => 1
            ],
        ];

        foreach ($userData as $val) {
            User::updateOrCreate(
                ['email' => $val['email']], // supaya tidak dobel jika seeder diulang
                $val
            );
        }
    }
}
