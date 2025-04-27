@extends('layouts.frontend')

@section('content')
<div class="container py-12 grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Konten Berita Utama -->
    <div class="lg:col-span-3">
        <!-- Gambar -->
        <div class="w-full overflow-hidden rounded-lg mb-4">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                 class="w-full h-auto max-h-[350px] object-cover rounded-xl shadow">
        </div>

        <!-- Judul Berita -->
        <h1 class="text-3xl font-extrabold text-gray-900 mb-4">{{ $berita->judul }}</h1>

        <!-- Konten Berita -->
        <div class="prose prose-lg max-w-none text-gray-700 mb-6">
            {!! $berita->konten !!}
        </div>

        <!-- Info Tambahan -->
        <p class="text-sm text-gray-500 mb-6">Diterbitkan pada {{ $berita->created_at->format('d M Y') }}</p>

        <!-- Tombol Kembali -->
        <a href="{{ route('berita.index') }}" class="inline-block text-emerald-600 hover:underline">
            ← Kembali ke Daftar Berita
        </a>
    </div>

    <!-- Sidebar Berita Lainnya -->
    <div class="lg:col-span-1">
        <h3 class="text-xl font-semibold mb-4">Berita Lainnya</h3>
        <div class="space-y-4">
            @foreach($beritaLainnya as $item)
            <div class="flex items-center border-b pb-4">
                <div class="w-16 h-16 overflow-hidden rounded-lg mr-4">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <a href="{{ route('berita.show', $item->slug) }}" class="block">
                        <h4 class="text-base font-medium text-gray-800 hover:text-emerald-600">
                            {{ Str::limit($item->judul, 60) }}
                        </h4>
                        <p class="text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</p>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection