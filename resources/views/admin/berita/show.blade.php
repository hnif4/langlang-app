@extends('layouts.app')

@section('title', 'Detail Berita')

@section('content')

    <div class="container mx-auto py-6">
        <div class="bg-white shadow-md rounded p-6">
            <h3 class="text-2xl font-bold mb-4">{{ $berita->judul }}</h3>

            <p class="text-sm text-gray-600 mb-2">
                <strong>Kategori:</strong> {{ $berita->category->nama }}
            </p>

            @if($berita->gambar)
                <img src="{{ asset('storage/'.$berita->gambar) }}"
                     alt="Gambar Berita"
                     class="w-64 object-cover rounded mb-4">
            @endif

            <div class="prose max-w-none">
                {!! nl2br(e($berita->konten)) !!}
            </div>

            <p class="text-xs text-gray-500 mt-4">
                <strong>Dibuat pada:</strong> {{ $berita->created_at->format('d M Y, H:i') }}<br>
                <strong>Diperbarui pada:</strong> {{ $berita->updated_at->format('d M Y, H:i') }}
            </p>

            <div class="mt-6">
                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('admin.berita.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
