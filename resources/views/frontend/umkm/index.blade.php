@extends('layouts.frontend')

@section('content')
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-semibold text-center text-emerald-600 mb-4 animate-fade-in">
            Tentang UMKM Kami
        </h2>
        <p class="text-gray-600 text-center mb-12 animate-fade-in delay-200">
            Mendukung UMKM Indonesia
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($umkms as $index => $umkm)
            <div class="group card bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-500 hover:bg-blue-50 hover:-translate-y-2 hover:scale-105 hover:shadow-xl hover:ring-2 hover:ring-blue-200 opacity-0 animate-fade-in-up delay-[{{ $index * 100 }}ms]">
                <img src="{{ asset('storage/' . $umkm->gambar) }}" alt="{{ $umkm->judul }}"
                    class="w-full h-48 object-cover transition duration-500 group-hover:scale-110">
                <div class="p-4">
                    <h3 class="text-xl font-medium text-gray-800 transition duration-300 group-hover:text-emerald-600">
                        {{ $umkm->judul }}
                    </h3>
                    <p class="text-sm text-gray-600 mt-2">{{ Str::limit($umkm->deskripsi, 200) }}</p>
                    <div class="mt-4 flex gap-4">
                        <a href="https://wa.me/{{ $umkm->kontak }}" target="_blank"
                            class="bg-green-500 text-white py-2 px-4 rounded-md text-sm text-center hover:hover:bg-yellow-600 w-full transition">
                            Pesan
                        </a>
                        <a href="{{ route('frontend.umkm.show', $umkm->slug) }}"
                            class="bg-blue-500 text-white py-2 px-4 rounded-md text-sm text-center hover:bg-blue-600 w-full transition">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection