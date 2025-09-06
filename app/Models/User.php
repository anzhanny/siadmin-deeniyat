<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'class_id',
        'name',
        'email',
        'password',
        'birthplace',
        'birthdate',
        'gender',
        'father_name',
        'mother_name',
        'father_job',
        'mother_job',
        'address',
        'phone',
        'academic_year',
        'batch',
        'is_active',
        'is_paid',
        'paid_at',
        'photo',
        'nis'
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(TbClass::class, 'class_id', 'id');
    }

    /**
     * Generate NIS otomatis
     * Format: Tahun Akademik (4 digit) + Batch (2 digit) + Nomor Urut (5 digit)
     */
    public static function generateNis($academicYear, $batch)
    {
        // Ambil siswa terakhir sesuai academicYear & batch
        $lastStudent = self::where('academic_year', $academicYear)
            ->where('batch', $batch)
            ->orderBy('nis', 'desc')
            ->first();

        $nextNumber = 1; // default
        if ($lastStudent) {
            // Ambil 5 digit terakhir NIS sebagai nomor urut
            $lastNumber = intval(substr($lastStudent->nis, -5));
            $nextNumber = $lastNumber + 1;
        }

        return $academicYear . $batch . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Booted: otomatis generate NIS saat creating
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            // Academic year 2 digit + 2 digit
            $yearStart = date('y'); // contoh 25
            $yearEnd = date('y', strtotime('+1 year')); // contoh 26
            $user->academic_year = $yearStart . $yearEnd;

            // Batch otomatis: tahun masuk dikurangi tahun pertama angkatan (misal 2012)
            $baseYear = 2012;
            $currentYear = date('Y');
            $user->batch = str_pad(($currentYear - $baseYear + 1), 2, '0', STR_PAD_LEFT);

            // Generate NIS sesuai academic_year & batch
            $user->nis = self::generateNis($user->academic_year, $user->batch);
        });
    }
}
