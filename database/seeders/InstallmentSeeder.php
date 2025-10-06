<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TbClass;
use App\Models\Installment;
use App\Models\Payment;
use Carbon\Carbon;

class InstallmentSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'siswa1@example.com'],
            [
                'name' => 'Siswa Cicilan',
                'password' => bcrypt('password'),
                'class_id' => 1,
                'role_id' => 2,
                'phone' => '08123456789',
            ]
        );

        $installment = Installment::create([
            'code' => 'REG-' . strtoupper(uniqid(13)),
            'user_id' => $user->id,
            'class_id' => $user->class_id,
            'total_amount' => 450000,
            'total_parts' => 3,
            'status' => 'pending',
        ]);

        $nominal = 150000;
        for ($i = 1; $i <= 3; $i++) {
            Payment::create([
                'installment_id' => $installment->id,
                'amount' => $nominal,
                'status' => $i === 1 ? 'paid' : 'pending',
                'paid_at' => $i === 1 ? Carbon::now() : null,
                'due_date' => Carbon::now()->addMonths($i - 1),
                'user_id' => $user->id,
                'class_id' => $user->class_id,
            ]);
        }

        $installment->updateStatus();
    }
}
