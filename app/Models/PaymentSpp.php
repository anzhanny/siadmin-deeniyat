<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSpp extends Model
{
    use HasFactory;

    protected $table = 'tb_payment_spp';
    protected $fillable = 
    [
        'student_id',
        'class_id',
        'month',
        'payment_status',
        'paid_at',
        'upload_transactions'
    ];
    protected $dates = ['paid_at', 'created_at', 'updated_at'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(TbClass::class, 'class_id', 'id');
    }
}
