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
        'academic_year_first',
        'academic_year_last',
        'status',
    ];
    protected $dates = ['created_at', 'updated_at'];

}
