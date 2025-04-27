<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Umkm; // Model Umkm
use Illuminate\Http\Request;

class VUmkmController extends Controller
{
    // Menampilkan halaman utama tentang UMKM
    public function index()
    {
        // Ambil semua data UMKM
        $umkms = Umkm::all(); 

        return view('frontend.umkm.index', compact('umkms'));
    }

    // Menampilkan detail UMKM berdasarkan slug
    public function show($slug)
{
    $umkm = Umkm::where('slug', $slug)->firstOrFail();

    $rekomendasi = Umkm::where('id', '!=', $umkm->id)
                        ->inRandomOrder()
                        ->limit(4)
                        ->get();

    return view('frontend.umkm.show', compact('umkm', 'rekomendasi'));
}

}
