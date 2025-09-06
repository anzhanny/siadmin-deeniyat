<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'role_id',
        'email',
        'password',
        'class_id',
        'is_active',
        'email_verified_at',
        'remember_token',
        'birthplace',
        'birthdate',
        'gender',
        'formal_education',
        'nis',
        'phone',
        'address',
        'father_name',
        'father_job',
        'mother_name',
        'mother_job',
        'photo',

    ];
    protected $dates = ['created_at', 'updated_at'];

public static function generateNis($angkatan)
{
    // Ambil tahun ajaran (misal 2024/2025 jadi "2425")
    $academic_year_first = date('y'); // 24
    $academic_year_last = date('y', strtotime('+1 year')); // 25
    $academicYear = $academic_year_first . $academic_year_last; // 2425

    // Ambil NIS terakhir untuk tahun ajaran + angkatan ini
    $last = self::where('nis', 'LIKE', $academicYear . $angkatan . '%')
        ->orderBy('id', 'desc')
        ->first();

    // Nomor urut
    if ($last) {
        $lastNumber = (int)substr($last->nis, -6); 
        $number = $lastNumber + 1;
    } else {
        $number = 1;
    }

    // Format: tahun ajaran + angkatan + no urut (6 digit)
    return $academicYear . str_pad($angkatan, 2, '0', STR_PAD_LEFT) . str_pad($number, 6, '0', STR_PAD_LEFT);
}

protected static function booted()
{
    static::saving(function ($user) {
        if ($user->is_paid && !$user->nis) {
            // contoh ambil angkatan dari class_id atau inputan
            $angkatan = $user->class_id ?? 1;

            $user->nis = self::generateNis($angkatan);
            $user->paid_at = now();
        }
    });
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
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
