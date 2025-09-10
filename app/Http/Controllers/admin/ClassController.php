<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TbClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TbClass::withCount('user')->paginate(20);
        return view('admin.class.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = TbClass::all();
        return view('admin.class.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:100',
            'rombel' => 'required|integer|min:1|max:10',
            'academic_year_first' => 'required|string|max:10',
            'academic_year_last' => 'required|string|max:10',
        ]);

        $base = $request->class_base;
        $rombel = $request->rombel;

        for ($i = 0; $i < $rombel; $i++) {
            $suffix = chr(65 + $i); // "A", "B", "C"
            $className = "Kelas {$base}{$suffix}";

            TbClass::create([
                'class_name' => $className,
                'amount' => 15, // kuota fix
                'teacher_name' => null,
                'academic_year_first' => $request->academic_year_first,
                'academic_year_last' => $request->academic_year_last,
            ]);
        }

        return redirect()->route('admin.class.index')
            ->with('success', 'Kelas baru berhasil dibuat otomatis');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = TbClass::findOrFail($id);
        return view('admin.class.show', compact('class'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = TbClass::findOrFail($id);
        return view('admin.class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'class_name' => 'required|string|max:100',
            'amount' => 'nullable|integer|min:2',
            'teacher_name' => 'nullable|string|max:100',
            'academic_year_first' => 'required|string|max:10',
            'academic_year_last' => 'required|string|max:10',
        ]);

        $data = TbClass::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('admin.class.index')
            ->with('success', 'Data berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TbClass::findOrFail($id)->delete();
        return redirect()->route('admin.class.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
