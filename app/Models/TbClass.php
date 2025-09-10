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

    public static function assignStudentToClass($grade, $studentId)
    {
        // cari semua kelas di tingkat tsb (misal: "Kelas 1%")
        $classes = self::where('class_name', 'like', "Kelas {$grade}%")
            ->orderBy('class_name', 'asc')
            ->get();

        $targetClass = null;

        foreach ($classes as $class) {
            if ($class->user()->count() < $class->amount) {
                $targetClass = $class;
                break;
            }
        }

        // kalau semua penuh → buat kelas baru
        if (!$targetClass) {
            $lastClass = $classes->last();
            $suffix = $lastClass ? substr($lastClass->class_name, -1) : '@'; // sebelum "A"
            $newSuffix = chr(ord($suffix) + 1);
            $className = "Kelas {$grade}{$newSuffix}";

            $targetClass = self::create([
                'class_name' => $className,
                'amount' => 15, // default kuota
                'teacher_name' => null,
                'academic_year_first' => now()->year,
                'academic_year_last' => now()->year + 1,
            ]);
        }

        // assign siswa ke kelas
        $user = \App\Models\User::findOrFail($studentId);
        $user->class_id = $targetClass->id;
        $user->save();

        return $targetClass;
    }
}
