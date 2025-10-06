<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PaymentTestSeeder extends Seeder
{
    public function run(): void
    {
        // contoh siswa id=2 (role student)
        $userId = 2;

        // ---- CASE 1: Pembayaran LUNAS langsung ----
        DB::table('tb_payments')->insert([
            'installment_id'   => null, // tidak pakai cicilan
            'user_id'          => $userId,
            'class_id'         => 1,
            'payment_for'      => 'register',
            'payment_category' => 'lunas',
            'payment_type'     => 'tunai',
            'code'             => 'PAY-REG-001',
            'amount'           => 500000,
            'method'           => 'manual',
            'status'           => 'paid',
            'paid_at'          => Carbon::now(),
            'created_at'       => Carbon::now(),
            'updated_at'       => Carbon::now(),
        ]);

        // ---- CASE 2: Pembayaran CICILAN ----
        // buat parent installment
        $installmentId = DB::table('tb_installment')->insertGetId([
            'user_id'          => $userId,
            'nominal'          => 900000,   // total hutang
            'remaining_balance'=> 600000,   // masih ada sisa
            'due_date'         => Carbon::now()->addDays(30),
            'status'           => 'partial',
            'created_at'       => Carbon::now(),
            'updated_at'       => Carbon::now(),
        ]);

        // cicilan pertama
        DB::table('tb_payments')->insert([
            'installment_id'   => $installmentId,
            'user_id'          => $userId,
            'class_id'         => 1,
            'payment_for'      => 'spp',
            'payment_category' => 'cicilan',
            'payment_type'     => 'non-tunai',
            'code'             => 'PAY-CICIL-001',
            'amount'           => 300000,
            'method'           => 'midtrans',
            'month'            => 'September',
            'year'             => '2025',
            'status'           => 'paid',
            'paid_at'          => Carbon::now(),
            'created_at'       => Carbon::now(),
            'updated_at'       => Carbon::now(),
        ]);

        // cicilan kedua (belum bayar)
        DB::table('tb_payments')->insert([
            'installment_id'   => $installmentId,
            'user_id'          => $userId,
            'class_id'         => 1,
            'payment_for'      => 'spp',
            'payment_category' => 'cicilan',
            'payment_type'     => 'non-tunai',
            'code'             => 'PAY-CICIL-002',
            'amount'           => 300000,
            'method'           => 'midtrans',
            'month'            => 'Oktober',
            'year'             => '2025',
            'status'           => 'pending',
            'paid_at'          => null,
            'created_at'       => Carbon::now(),
            'updated_at'       => Carbon::now(),
        ]);
    }
}
