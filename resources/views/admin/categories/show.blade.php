@extends('layouts.app')

@section('title', 'Detail Profil Desa')

@section('content')

    <div class="container mx-auto py-6">
        <div class="bg-white shadow-md rounded p-6">
            <h3 class="text-2xl font-bold mb-4">{{ $category->nama }}</h3>

            <div class="mb-2">
                <strong>Slug:</strong> {{ $category->slug }}
            </div>

            <div class="mb-4 text-xs text-gray-500">
                <strong>Dibuat pada:</strong> {{ $category->created_at->format('d M Y, H:i') }}
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('admin.categories.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </div>
    @endsection
