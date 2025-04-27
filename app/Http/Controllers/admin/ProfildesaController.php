<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilDesa;

class ProfilDesaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
    
        // Jika ada query pencarian, filter hasil berdasarkan judul atau konten
        $profildesa = ProfilDesa::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('judul', 'like', "%{$query}%")
                                ->orWhere('konten', 'like', "%{$query}%");
        })->get();
    
        return view('admin.profil-desa.index', compact('profildesa'));
    }
    

    public function create()
    {
        return view('admin.profil-desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'slug' => 'required|unique:profil_desas',
            'tipe' => 'required',
            'konten' => 'required',
        ]);

        ProfilDesa::create($request->all());

        return redirect()->route('admin.profil-desa.index')->with('success', 'Profil Desa berhasil ditambahkan');
    }

    public function show($id)
    {
        $profil = ProfilDesa::findOrFail($id);
        return view('admin.profil-desa.show', compact('profil'));
    }

    public function edit($id)
    {
        $profil = ProfilDesa::findOrFail($id);
        return view('admin.profil-desa.edit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'slug' => 'required|unique:profil_desas,slug,' . $id,
            'tipe' => 'required',
            'konten' => 'required',
        ]);

        $profil = ProfilDesa::findOrFail($id);
        $profil->update($request->all());

        return redirect()->route('admin.profil-desa.index')->with('success', 'Profil Desa berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $profil = ProfilDesa::findOrFail($id);
            $profil->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Profil Desa berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data.'
            ], 500);
        }
    }
}
