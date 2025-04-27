<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WisataController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query'); // Ambil input pencarian dari user

        // Ambil data Wisata dengan opsi pencarian
        $wisatas = Wisata::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('judul', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%")
                ->orWhere('lokasi', 'like', "%{$query}%");  // Pencarian di kolom judul, deskripsi, dan lokasi
        })
            ->with('category')  // Menambahkan relasi category
            ->latest()  // Urutkan berdasarkan terbaru
            ->get();

        // Kembalikan ke view dengan data Wisata
        return view('admin.wisata.index', compact('wisatas'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.wisata.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'jam_operasional' => 'nullable',
            'kontak' => 'nullable',
            'category_id' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'harga_tiket' => 'required|numeric', // Menambahkan validasi harga_tiket
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
        }

        Wisata::create($data);

        return redirect()->route('admin.wisata.index')->with('success', 'Wisata berhasil ditambahkan!');
    }

    public function show($id)
    {
        $item = Wisata::with('category')->findOrFail($id);
        return view('admin.wisata.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Wisata::findOrFail($id);
        $categories = Category::all();
        return view('admin.wisata.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $item = Wisata::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'jam_operasional' => 'nullable',
            'kontak' => 'nullable',
            'category_id' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'harga_tiket' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.wisata.index')->with('success', 'Wisata berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $item = Wisata::findOrFail($id);
            $item->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Wisata berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus wisata.',
            ], 500);
        }
    }
}
