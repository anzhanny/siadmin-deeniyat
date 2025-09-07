<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbClass extends Model
{
    use HasFactory;
    protected $table = 'tb_class';
    protected $fillable = [
        'class_name',
        'amount',
        'teacher_name',
        'academic_year_first',
        'academic_year_last',
        'registration_fee',
        'infrastructure_fee',
        'uniform_fee',
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'class_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'class_id', 'id');
    }
}
