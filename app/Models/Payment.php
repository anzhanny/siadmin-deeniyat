<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'tb_payments';
    protected $fillable = 
    [
        'payment_type',
        'amount',
        'method',
        'month',
        'reference_number',
        'status',
        'description',
    ];
    protected $dates = ['paid_at', 'created_at', 'updated_at'];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(TbClass::class, 'class_id', 'id');
    }
}
