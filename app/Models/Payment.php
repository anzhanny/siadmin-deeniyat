<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'tb_payments';

    protected $fillable = [
        'installment_id',
        'user_id',
        'class_id',
        'payment_for',    // register / spp
        'payment_category', // lunas / cicilan
        'payment_type', // tunai / non-tunai
        'method', // midtrans
        'code',           // kode pembayaran unik
        'due_date',      // jatuh tempo per cicilan
        'amount',         // total bayar
        'installment_to', // ke berapa cicilan
        'description',    // keterangan tambahan
        'month',          // bulan (jika SPP)
        'year',           // tahun (jika SPP)
        'status',         // pending / paid / canceled
        'paid_at',        // kapan dibayar
    ];

    protected $dates = ['created_at', 'updated_at', 'paid_at'];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'due_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(TbClass::class, 'class_id', 'id');
    }

    // Relasi ke Installment
    public function installment()
    {
        return $this->belongsTo(Installment::class, 'installment_id', 'id');
    }

    // protected static function booted()
    // {
    //     static::created(function ($payment) {
    //         if ($payment->installment) {
    //             $payment->installment->updateStatus();
    //         }
    //     });

    //     static::updated(function ($payment) {
    //         if ($payment->isDirty('status') && $payment->installment) {
    //             $payment->installment->updateStatus();
    //         }
    //     });
    // }
}
