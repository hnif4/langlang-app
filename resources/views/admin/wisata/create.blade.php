@extends('layouts.app')

@section('title', 'Tambah Wisata')

@section('content')

    <div class="container mx-auto py-6">
        <form action="{{ route('admin.wisata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <!-- Input untuk harga_tiket di form create dan edit -->
            <div class="mb-4">
                <label for="harga_tiket" class="block text-sm font-medium text-gray-700">Harga Tiket</label>
                <input type="number" name="harga_tiket" id="harga_tiket" value="{{ old('harga_tiket', $wisata->harga_tiket ?? '') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>


            <div class="mb-4">
                <label for="jam_operasional" class="block text-sm font-medium text-gray-700">Jam Operasional</label>
                <input type="text" name="jam_operasional" id="jam_operasional" value="{{ old('jam_operasional') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="kontak" class="block text-sm font-medium text-gray-700">Kontak</label>
                <input type="text" name="kontak" id="kontak" value="{{ old('kontak') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" id="category_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" name="gambar" id="gambar"
                    class="mt-1 block w-full" accept="image/*">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
@endsection