@extends('layouts.frontend')

@section('content')
<div class="container py-12">
    <h2 class="text-3xl font-semibold text-center text-emerald-600 mb-4 animate-fade-in">
        Berita terkini
    </h2>
    <p class="text-gray-600 text-center mb-12 animate-fade-in delay-200">
    Informasi dan berita terbaru dari desa kami.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($beritas as $berita)
        <a href="{{ route('berita.show', $berita->slug) }}" class="block bg-white rounded-lg shadow-lg overflow-hidden group hover:-translate-y-2 hover:shadow-2xl opacity-0 animate-fade-in-up delay-[{{ $loop->index * 100 }}ms]">
            <!-- Gambar -->
            <div class="relative">
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                    class="w-full h-48 object-cover">
                <!-- Hover overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center transform -translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                    <span class="text-white text-3xl font-bold">+</span>
                </div>
            </div>

            <!-- Konten -->
            <div class="p-4">
                <div class="bg-gray-200 text-gray-800 text-sm px-3 py-1 rounded-lg inline-block mb-4">
                    {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}
                </div>
                <h3 class="text-xl font-semibold text-gray-800">{{ $berita->judul }}</h3>
                <p class="text-sm text-gray-600 mt-2">
                    {{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 100) }}
                </p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection