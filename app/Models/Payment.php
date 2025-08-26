<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'tb_payments';
    protected $fillable =
    [
        'user_id',
        'class_id',
        'payment_type',
        'amount',
        'method',
        'month',
        'status',
        'paid_at'
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(TbClass::class, 'class_id', 'id');
    }

    public function payments()
{
    return $this->hasMany(Payment::class, 'user_id');
}

}
