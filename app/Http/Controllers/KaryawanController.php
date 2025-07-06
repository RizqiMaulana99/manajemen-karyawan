<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
   public function index(Request $request)
{
    $search = $request->input('search');

    $karyawans = Karyawan::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('jabatan', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);

    return view('karyawan.index', compact('karyawans', 'search'));
}

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required',
        'jabatan' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('foto', 'public');
        $validated['foto'] = $fotoPath;
    }

    Karyawan::create($validated);

    return redirect()->route('karyawan.index')->with('success', 'Data berhasil ditambahkan');
}


    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan)
{
    $validated = $request->validate([
        'nama' => 'required',
        'jabatan' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($request->hasFile('foto')) {
        
        if ($karyawan->foto && file_exists(public_path('storage/' . $karyawan->foto))) {
            unlink(public_path('storage/' . $karyawan->foto));
        }
        $fotoPath = $request->file('foto')->store('foto', 'public');
        $validated['foto'] = $fotoPath;
    }

    $karyawan->update($validated);

    return redirect()->route('karyawan.index')->with('success', 'Data berhasil diupdate');
}


    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus');
    }
}
