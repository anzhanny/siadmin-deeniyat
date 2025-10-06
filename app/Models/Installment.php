<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $table = 'tb_installment';
    protected $fillable = [
        'user_id',
        'nominal',
        'remaining_balance',
        'due_date',
        'status',
        'paid_at'
    ];

    protected $dates = [
        'paid_at',
        'due_date',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_at'  => 'datetime',
    ];


    public function payments()
    {
        return $this->hasMany(Payment::class, 'installment_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function class()
    {
        return $this->hasOneThrough(
            TbClass::class,
            Payment::class,
            'installment_id', // FK di Payment yg referensi ke Installment
            'id',             // PK di TbClass
            'id',             // PK di Installment
            'class_id'        // FK di Payment ke TbClass
        );
    }




    public function updateStatus()
{
    $totalPaid = $this->payments()->where('status', 'paid')->sum('amount');
    $totalNominal = $this->nominal; // total_amount dari parent

    if ($totalPaid >= $totalNominal) {
        $this->status  = 'paid';
        $this->paid_at = now();
    } elseif ($totalPaid > 0) {
        $this->status = 'partial';
    } else {
        $this->status = 'pending';
    }

    // update remaining_balance
    $this->remaining_balance = max($totalNominal - $totalPaid, 0);
    $this->save();
}

}
