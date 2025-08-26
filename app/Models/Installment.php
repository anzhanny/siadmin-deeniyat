<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $table = 'tb_installment';
    protected $fillable = [
        'payment_id',
        'nominal',
        'installments_to',
        'paid_at',
        'remaining_balance',
    ];

    // Relasi ke Payment (jika ada tabel payments)
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
