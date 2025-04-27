@extends('layouts.app')

@section('title', 'Tambah Slider')

@section('content')

    <div class="container mx-auto py-6">
        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
                <input type="url" name="link" id="link" value="{{ old('link') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
@endsection
