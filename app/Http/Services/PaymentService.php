<?php

namespace App\Http\Services;

use App\Repositories\TransactionRepositoryInterface;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentService
{
    protected $transactionRepository;

    public function __construct( $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function processPayment($data)
    {
        // Simpan transaksi ke database menggunakan repository
        $transaction = $this->transactionRepository->createTransaction([
            'product_id' => $data['code'],
            'customer_id' => $data['user_id'],
            'quantity' => 1,
            'total_price' => $data['amount'],
            'status' => 'pending'
        ]);

        // Membuat Snap Token Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => $transaction->total_price
            ],
            'customer_details' => [
                'first_name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone']
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return [
            'transaction' => $transaction,
            'snap_token' => $snapToken
        ];
    }
}
