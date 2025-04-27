@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')

    <div class="container mx-auto py-6">
        <form action="{{ route('admin.berita.update', $berita->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text"
                       name="judul"
                       id="judul"
                       value="{{ old('judul', $berita->judul) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                       required>
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text"
                       name="slug"
                       id="slug"
                       value="{{ old('slug', $berita->slug) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                       required>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id"
                        id="category_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                          {{ old('category_id', $berita->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Gambar Lama</label>
                @if($berita->gambar)
                    <img src="{{ asset('storage/'.$berita->gambar) }}"
                         alt=""
                         class="w-32 h-32 object-cover rounded mb-2">
                @endif
                <input type="file"
                       name="gambar"
                       id="gambar"
                       class="mt-1 block w-full"
                       accept="image/*">
            </div>

            <div class="mb-4">
                <label for="konten" class="block text-sm font-medium text-gray-700">Konten</label>
                <textarea name="konten"
                          id="konten"
                          rows="8"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                          required>{{ old('konten', $berita->konten) }}</textarea>
            </div>

            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
@endsection
