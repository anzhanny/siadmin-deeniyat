<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'tb_payments';

    protected $fillable = [
        'user_id',
        'class_id',
        'payment_category', // lunas / cicilan
        'payment_type', // tunai / non-tunai
        'code',           // kode pembayaran unik
        'amount',         // total bayar
        'method',         // metode pembayaran
        'month',          // bulan (jika SPP)
        'year',           // tahun (jika SPP)
        'status',         // pending / paid / canceled
        'paid_at',        // kapan dibayar
    ];

    protected $dates = ['created_at', 'updated_at', 'paid_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(TbClass::class, 'class_id', 'id');
    }
}
