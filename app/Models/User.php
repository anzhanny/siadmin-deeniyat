<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
                    'birthdate' => 'date',
        ];
    }

    // 🔹 Relasi Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    // 🔹 Relasi Kelas
    public function class()
    {
        return $this->belongsTo(TbClass::class, 'class_id', 'id');
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'user_id');
    }
    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class, 'user_id', 'id');
    }


    /**
     * Generate NIS otomatis
     * Format: Tahun Akademik (4 digit) + Batch (2 digit) + Nomor Urut (5 digit)
     */
    public static function generateNis($academicYear, $batch)
    {
        $lastStudent = self::where('academic_year', $academicYear)
            ->where('batch', $batch)
            ->orderBy('nis', 'desc')
            ->first();

        $nextNumber = 1;
        if ($lastStudent) {
            $lastNumber = intval(substr($lastStudent->nis, -5));
            $nextNumber = $lastNumber + 1;
        }

        return $academicYear . $batch . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Boot: generate NIS saat creating + hapus relasi saat deleting
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $yearStart = date('y');
            $yearEnd = date('y', strtotime('+1 year'));
            $user->academic_year = $yearStart . $yearEnd;

            $baseYear = 2012;
            $currentYear = date('Y');
            $user->batch = str_pad(($currentYear - $baseYear + 1), 2, '0', STR_PAD_LEFT);

            $user->nis = self::generateNis($user->academic_year, $user->batch);
        });

        static::deleting(function ($user) {
            foreach ($user->installments as $installment) {
                $installment->payments()->delete();
                $installment->delete();
            }
        });
    }
}
