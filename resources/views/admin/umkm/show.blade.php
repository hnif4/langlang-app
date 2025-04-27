@extends('layouts.app')

@section('title', 'Detail UMKM')

@section('content')

    <div class="container mx-auto py-6">
        <div class="bg-white shadow-md rounded p-6">
            <h3 class="text-2xl font-bold mb-4">{{ $item->judul }}</h3>

            @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" class="mb-4 w-64 rounded" alt="gambar UMKM">
            @endif

            <div class="mb-2">
                <strong>Slug:</strong> {{ $item->slug }}
            </div>

            <div class="mb-2">
                <strong>Deskripsi:</strong>
                <p class="text-gray-700">{{ $item->deskripsi }}</p>
            </div>

            <div class="mb-2">
                <strong>Harga:</strong> Rp{{ number_format($item->harga, 0, ',', '.') }}
            </div>

            <div class="mb-2">
                <strong>Kontak:</strong> {{ $item->kontak }}
            </div>

            <div class="mb-2">
                <strong>Kategori:</strong> {{ $item->category->nama ?? '-' }}
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.umkm.edit', $item->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('admin.umkm.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
