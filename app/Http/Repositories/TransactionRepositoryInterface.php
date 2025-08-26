<?php

namespace App\Http\Repositories;

interface TransactionRepositoryInterface
{
    public function createTransaction(array $data);
}