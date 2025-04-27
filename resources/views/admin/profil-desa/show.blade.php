@extends('layouts.app')

@section('title', 'Detail Profil Desa')

@section('content')

    <div class="container mx-auto py-6">
        <div class="bg-white shadow-md rounded p-6">
            <h3 class="text-2xl font-bold mb-4">{{ $profil->judul }}</h3>

            <div class="mb-2">
                <strong>Slug:</strong> {{ $profil->slug }}
            </div>

            <div class="mb-2">
                <strong>Tipe:</strong> {{ ucfirst(str_replace('_', ' ', $profil->tipe)) }}
            </div>

            <div class="prose max-w-none mb-4">
                {!! nl2br(e($profil->konten)) !!}
            </div>

            <div class="text-xs text-gray-500 mb-4">
                <strong>Dibuat pada:</strong> {{ $profil->created_at->format('d M Y, H:i') }}<br>
                <strong>Diperbarui pada:</strong> {{ $profil->updated_at->format('d M Y, H:i') }}
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.profil-desa.edit', $profil->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('admin.profil-desa.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </div>
    @endsection
