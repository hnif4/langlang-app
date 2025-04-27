<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\UMKM;
use App\Models\Berita;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Jika query kosong, kembalikan ke halaman sebelumnya tanpa pencarian
        if (empty($query)) {
            return redirect()->route('frontend.home'); // Atau halaman yang sesuai
        }

        // Mencari di tabel 'wisatas' berdasarkan 'judul'
        $wisatas = Wisata::where('judul', 'like', '%' . $query . '%')->get();

        // Mencari di tabel 'umkms' berdasarkan 'judul'
        $umkms = UMKM::where('judul', 'like', '%' . $query . '%')->get();

        // Mencari di tabel 'beritas' berdasarkan 'judul' atau 'konten'
        $beritas = Berita::where('judul', 'like', '%' . $query . '%')
                        ->orWhere('konten', 'like', '%' . $query . '%')
                        ->get();

        // Cari di tabel 'profil_desas' berdasarkan 'judul' atau 'konten'
        $profilDesas = ProfilDesa::where('judul', 'like', '%' . $query . '%')
                        ->orWhere('konten', 'like', '%' . $query . '%')
                        ->get();

        // Mengirim data hasil pencarian ke view
        return view('frontend.search', compact('wisatas', 'umkms', 'beritas','profilDesas', 'query'));
    }
}
