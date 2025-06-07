<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbClass extends Model
{
    use HasFactory;
    protected $table = 'tb_class';
    protected $fillable = 
    [
        'class_name',
        'teacher_id'
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

}
