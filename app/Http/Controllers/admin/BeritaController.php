<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Category;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');

    // Mulai query dasar, load relasi category
    $beritas = Berita::with('category');

    // Kalau ada input pencarian, filter berdasarkan judul atau konten
    if ($query) {
        $beritas->where(function ($q) use ($query) {
            $q->where('judul', 'like', "%{$query}%")
              ->orWhere('konten', 'like', "%{$query}%");
        });
    }

    // Eksekusi query
    $beritas = $beritas->get();

    return view('admin.berita.index', compact('beritas'));
}


    public function create()
    {
        // Perlu daftar kategori untuk select dropdown
        $categories = Category::all();
        return view('admin.berita.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'slug'        => 'required|unique:beritas,slug',
            'konten'      => 'required',
            'category_id' => 'required|exists:categories,id',
            'gambar'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil ditambahkan');
    }

    public function show($id)
    {
        $berita = Berita::with('category')->findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }

    public function edit($id)
    {
        $berita     = Berita::findOrFail($id);
        $categories = Category::all();
        return view('admin.berita.edit', compact('berita', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'slug'        => 'required|unique:beritas,slug,' . $id,
            'konten'      => 'required',
            'category_id' => 'required|exists:categories,id',
            'gambar'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // (opsional) hapus file lama di storage jika ada
            // Storage::disk('public')->delete($berita->gambar);
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            $berita->delete();

            return response()->json([
                'status'  => 'success',
                'message' => 'Berita berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal menghapus berita'
            ], 500);
        }
    }
}
