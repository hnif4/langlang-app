@extends('layouts.frontend')

@section('content')
<div class="container py-12">
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden p-6">
        
        <!-- Judul -->
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 text-center">
            {{ $umkm->judul }}
        </h1>

        <!-- Konten utama: Deskripsi & Gambar -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            
            <!-- Kiri: Deskripsi & Harga -->
            <div>
                <p class="text-gray-700 leading-relaxed mb-6 whitespace-pre-line">
                    {{ $umkm->deskripsi }}
                </p>

                <p class="text-lg font-semibold text-gray-800 mb-6">
                    Harga: Rp{{ number_format($umkm->harga, 0, ',', '.') }}
                </p>

                <!-- Tombol Kontak -->
                <div class="mb-6">
                    <p class="text-lg font-semibold text-gray-800 mb-2">Kontak</p>
                    <a href="https://wa.me/{{ $umkm->kontak }}" target="_blank"
                       class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-5 rounded-lg transition">
                        Ayo pesan sekarang
                    </a>
                </div>
            </div>

            <!-- Kanan: Gambar -->
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $umkm->gambar) }}"
                     alt="{{ $umkm->judul }}"
                     class="w-72 h-72 object-cover rounded-lg shadow-md">
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-10 text-center">
            <a href="{{ url('/umkm') }}"
               class="text-gray-600 hover:text-emerald-600 underline text-sm">
                ← Kembali ke daftar UMKM
            </a>
        </div>
    </div>
</div>
@endsection
