<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MigrateStudentController extends Controller
{

    public function migrate()
    {
        $students = DB::table('tb_student')->get();

        foreach ($students as $student) {
            // Cek apakah email sudah ada di users untuk menghindari duplikat
            $exists = DB::table('users')->where('email', $student->email)->exists();
            if ($exists) {
                continue;
            }

            DB::table('users')->insert([
                'name' => $student->name,
                'email' => $student->email,
                'password' => $student->password, // atau bcrypt($student->password) jika belum di-hash
                'role' => 'student',
                'birthdate' => $student->birthdate,
                'gender' => $student->gender,
                'nis' => $student->nis,
                'phone' => $student->phone,
                'address' => $student->address,
                'class_id' => $student->class_id,
                'is_active' => $student->is_active,
                'father_name' => $student->father_name,
                'father_job' => $student->father_job,
                'mother_name' => $student->mother_name,
                'mother_job' => $student->mother_job,
                'photo' => $student->photo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return "Data siswa berhasil dipindahkan ke tabel users!";
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
