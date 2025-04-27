<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wisata;

class VWisataController extends Controller
{
    // Menampilkan semua data wisata
    public function index()
    {
        $wisatas = Wisata::all(); // Ambil semua data wisata
        return view('frontend.wisata.index', compact('wisatas'));
    }

    // Menampilkan detail wisata berdasarkan slug
    public function show($slug)
    {
        $wisata = Wisata::where('slug', $slug)->firstOrFail();
    
        // Ambil 3 wisata lain, kecuali yang sedang dilihat sekarang
        $wisataLainnya = Wisata::where('slug', '!=', $slug)
                                ->latest()
                                ->take(3)
                                ->get();
    
        return view('frontend.wisata.show', compact('wisata', 'wisataLainnya'));
    }

    
}
