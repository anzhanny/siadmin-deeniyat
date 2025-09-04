<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $birthplace = $request->input('birthplace');
        $birthdate = $request->input('birthdate');
        $gender = $request->input('gender');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $class_id = $request->input('class_id');
        $father_name = $request->input('father_name');
        $father_job = $request->input('father_job');
        $mother_name = $request->input('mother_name');
        $mother_job = $request->input('mother_job');
        $photo = $request->input('photo');

        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = new User();
        $data->name = $name;
        $data->role_id = 2;
        $data->email = $email;
        $data->password = bcrypt($password);
        $data->birthplace = $birthplace;
        $data->birthdate = $birthdate;
        $data->gender = $gender;
        $data->phone = $phone;
        $data->address = $address;
        $data->class_id = $class_id;
        $data->is_active = 1;
        $data->father_name = $father_name;
        $data->father_job = $father_job;
        $data->mother_name = $mother_name;
        $data->mother_job = $mother_job;
        $data->photo = $photo;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public'); // disimpan di storage/app/public/photos
            $data->photo = $path; // simpan path-nya ke database
        }

        $data->save();

        // Login otomatis setelah register
        Auth::login($data);

        // Store comprehensive student data in session
        session([
            'user_id' => $data->id,
            'class_id' => $data->class_id,
            'user_name' => $data->name,
            'user_email' => $data->email,
            'student_name' => $data->name,
            'student_email' => $data->email,
            'student_phone' => $data->phone,
            'student_address' => $data->address,
            'student_birthplace' => $data->birthplace,
            'student_birthdate' => $data->birthdate,
            'student_gender' => $data->gender,
            'student_class' => $this->getClassName($data->class_id),
            'father_name' => $data->father_name,
            'father_job' => $data->father_job,
            'mother_name' => $data->mother_name,
            'mother_job' => $data->mother_job,
        ]);

        // Check if this is an AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'redirect' => route('payment.detailpayment')
            ]);
        }

        return redirect()->route('payment.detailpayment');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            $user = Auth::user();

            if ($user->role_id == 1) {
                return redirect('/admin/dashboard');
            } elseif ($user->role_id == 2) {
                return redirect('/student/dashboard');
            } else {
                Auth::logout(); // kalau role-nya tidak dikenali
                return redirect('/')->withErrors('Role pengguna tidak dikenali.')->withInput();
            }
        } else {
            return redirect('/')->withErrors('Username dan password yang dimasukkan tidak sesuai!')->withInput();
        };
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
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

    /**
     * Get class name based on class ID
     */
    private function getClassName($classId)
    {
        $classNames = [
            0 => 'Kelas TK',
            1 => 'Kelas 1',
            2 => 'Kelas 2',
            3 => 'Kelas 3',
            4 => 'Kelas 4',
            5 => 'Kelas 5',
            6 => 'Kelas 6',
        ];

        return $classNames[$classId] ?? 'Kelas Tidak Diketahui';
    }
}
