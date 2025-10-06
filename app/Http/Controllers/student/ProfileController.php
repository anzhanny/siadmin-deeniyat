<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil user login
        $data = Auth::user();
        return view('student.profile.index', compact('data'));
    }

    public function edit()
    {
        $data = Auth::user();
        return view('student.profile.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $id,
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'father_job'  => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'mother_job'  => 'nullable|string|max:255',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password'    => 'nullable|string|min:6|confirmed',
        ]);

        // Update field umum
        $data->fill($request->except(['password', 'photo']));

        // Kalau ada password baru
        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }

        // Kalau upload foto baru
        if ($request->hasFile('photo')) {
            if ($data->photo && Storage::disk('public')->exists($data->photo)) {
                Storage::disk('public')->delete($data->photo);
            }
            $data->photo = $request->file('photo')->store('photos', 'public');
        }

        $data->save();

       return redirect()->route('student.profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
