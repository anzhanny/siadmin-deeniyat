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
        $role_id = $request->input('role_id');
        $email = $request->input('email');
        $password = $request->input('password');
        $birthdate = $request->input('birthdate');
        $gender = $request->input('gender');
        $nis = $request->input('nis');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $class_id = $request->input('class_id');
        $is_active = $request->input('is_active');
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
        $data->password = $password;
        $data->birthdate = $birthdate;
        $data->gender = $gender;
        $data->nis = $nis;
        $data->phone = $phone;
        $data->address = $address;
        $data->class_id = $class_id;
        $data->is_active = $is_active;
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
        return redirect()->route('finalpayment');
    }

    function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
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
}
