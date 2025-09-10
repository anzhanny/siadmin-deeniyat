<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\TbClass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua kelas dari tabel tb_classes
        $classes = TbClass::all();

        // Pilih 3 kelas random yang akan punya >15 siswa
        $classesWithMany = $classes->random(3);

        foreach ($classes as $class) {
            // Kalau kelas termasuk 3 yang dipilih → isi 16–20 siswa
            if ($classesWithMany->contains($class)) {
                $count = rand(16, 20);
            } else {
                // Sisanya isi 5–12 siswa
                $count = rand(5, 12);
            }

            for ($i = 0; $i < $count; $i++) {
                User::create([
                    'name'        => $faker->name,
                    'role_id'     => 2,
                    'email'       => $faker->unique()->safeEmail,
                    'password'    => Hash::make('password123'),
                    'birthplace'  => $faker->city,
                    'birthdate'   => $faker->dateTimeBetween('-12 years', '-5 years'),
                    'gender'      => $faker->randomElement(['Laki-laki', 'Perempuan']),
                    'phone'       => $faker->phoneNumber,
                    'address'     => $faker->address,
                    'class_id'    => $class->id, // nyambung ke kelas
                    'is_active'   => 1,
                    'father_name' => $faker->name('male'),
                    'father_job'  => $faker->randomElement(['PNS', 'Petani', 'Wiraswasta', 'Guru', 'Karyawan']),
                    'mother_name' => $faker->name('female'),
                    'mother_job'  => $faker->randomElement(['IRT', 'PNS', 'Wiraswasta', 'Guru']),
                    'photo'       => null,
                ]);
            }
        }
    }
}

