@extends('layouts.frontend')

@section('content')
<div class="container py-12">
    <h2 class="text-3xl font-semibold text-center text-emerald-600 mb-4 animate-fade-in">
        Destinasi Wisata Desa
    </h2>
    <p class="text-gray-600 text-center mb-12 animate-fade-in delay-200">
        Temukan pesona wisata lokal desa kami!
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($wisatas as $index => $wisata)
        <a href="{{ route('frontend.wisata.show', $wisata->slug) }}" class="block">
            <div
                class="card bg-white shadow-lg rounded-lg overflow-hidden transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl opacity-0 animate-fade-in-up delay-[{{ $index * 100 }}ms]">

                <!-- Gambar -->
                <div class="relative group">
                    <img src="{{ asset('storage/' . $wisata->gambar) }}" alt="{{ $wisata->judul }}" class="w-full h-48 object-cover">

                    <!-- Overlay tirai -->
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-xl font-semibold">{{ $wisata->judul }}</span>
                    </div>
                </div>

                <!-- Konten Deskripsi -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $wisata->judul }}</h3>
                    <p class="text-sm text-gray-500 mt-1 truncate"><i class="fas fa-map-marker-alt mr-1"></i>{{ $wisata->lokasi }}</p>
                    <p class="text-sm text-gray-600 mt-2">{{ Str::limit($wisata->deskripsi, 100) }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection