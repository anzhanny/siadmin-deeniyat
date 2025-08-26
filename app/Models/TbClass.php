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
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function payments()
{
    return $this->hasMany(Payment::class, 'class_id');
}

public function class()
{
    return $this->belongsTo(TbClass::class, 'class_id');
}


}
