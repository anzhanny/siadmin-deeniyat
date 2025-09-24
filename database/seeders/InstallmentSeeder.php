<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Payment;
use App\Models\Installment;
use Carbon\Carbon;

class InstallmentSeeder extends Seeder
{
    public function run(): void
    {
        // buat user siswa (kalau belum ada)
        $user = User::firstOrCreate(
            ['email' => 'siswa1@example.com'],
            [
                'name' => 'Siswa Cicilan',
                'password' => bcrypt('password'),
                'class_id' => 1, // pastikan ada class_id di tb_class
                'role_id' => 2,  // 2 = role student
                'phone' => '08123456789',
            ]
        );

        // buat payment induk
        $payment = Payment::create([
            'user_id' => $user->id,
            'class_id' => $user->class_id,
            'payment_for' => 'register',
            'payment_category' => 'cicilan',
            'payment_type' => 'non-tunai',
            'method' => 'midtrans',
            'code' => 'REG-' . strtoupper(uniqid()),
            'amount' => 450000,
            'status' => 'pending',
        ]);

        // generate cicilan 3x @150000
        $totalInstallments = 3;
        $nominal = 150000;

        for ($i = 1; $i <= $totalInstallments; $i++) {
            Installment::create([
                'payment_id' => $payment->id,
                'nominal' => $nominal,
                'installments_to' => $i,
                'remaining_balance' => 450000 - ($i * $nominal),
                'due_date' => Carbon::now()->addMonths($i - 1),
                'paid_at' => $i === 1 ? Carbon::now() : null, // cicilan 1 langsung dianggap dibayar
            ]);
        }
    }
}
