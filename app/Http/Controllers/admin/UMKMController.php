<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UMKM;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UMKMController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query'); // Ambil input pencarian dari user
    
        // Ambil data UMKM dengan opsi pencarian
        $umkms = UMKM::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('judul', 'like', "%{$query}%")
                                ->orWhere('deskripsi', 'like', "%{$query}%")
                                ->orWhere('harga', 'like', "%{$query}%");
        })
        ->with('category')  // Menambahkan relasi category
        ->latest()  // Urutkan berdasarkan terbaru
        ->get();
    
        // Kembalikan ke view dengan data UMKM
        return view('admin.umkm.index', compact('umkms'));
    }
    

    public function create()
    {
        $categories = Category::all();
        return view('admin.umkm.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'kontak' => 'required',
            'category_id' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('umkm', 'public');
        }

        UMKM::create($data);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil ditambahkan!');
    }

    public function show($id)
    {
        $item = UMKM::with('category')->findOrFail($id);
        return view('admin.umkm.show', compact('item'));
    }

    public function edit($id)
    {
        $item = UMKM::findOrFail($id);
        $categories = Category::all();
        return view('admin.umkm.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $item = UMKM::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'kontak' => 'required',
            'category_id' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('umkm', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $item = UMKM::findOrFail($id);
            $item->delete();
    
            return response()->json([
                'status' => 'success',
                'message' => 'UMKM berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus UMKM.',
            ], 500);
        }
    }
    
}
