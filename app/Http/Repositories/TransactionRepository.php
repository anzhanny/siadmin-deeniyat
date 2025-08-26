<?php
namespace App\Http\Repositories;

use App\Models\Payment;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function createTransaction(array $data)
    {
        return Payment::create($data);
    }
}