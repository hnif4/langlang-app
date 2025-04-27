<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    // Ambil semua kategori atau kategori yang dicari
    $query = $request->input('query');

    $categories = Category::when($query, function ($queryBuilder) use ($query) {
        return $queryBuilder->where('nama', 'like', "%{$query}%");
    })->get();

    return view('admin.categories.index', compact('categories'));
}


    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'slug' => 'required|unique:categories,slug,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data.'
            ], 500);
        }
    }

    public function show($id)
    {
        $category = Category::findOrFail($id); // Mencari kategori berdasarkan ID
        return view('admin.categories.show', compact('category'));
    }
}
