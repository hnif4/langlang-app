<!-- resources/views/admin/profil-desa/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Profil Desa')

@section('content')

    <div class="container mx-auto py-6">
        <form action="{{ route('admin.profil-desa.update', $profil->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                <input
                    type="text"
                    name="judul"
                    id="judul"
                    value="{{ old('judul', $profil->judul) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input
                    type="text"
                    name="slug"
                    id="slug"
                    value="{{ old('slug', $profil->slug) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="tipe" class="block text-sm font-medium text-gray-700">Tipe</label>
                <select
                    name="tipe"
                    id="tipe"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required
                >
                    <option value="wilayah"    {{ old('tipe', $profil->tipe) == 'wilayah'    ? 'selected' : '' }}>Wilayah</option>
                    <option value="sejarah"    {{ old('tipe', $profil->tipe) == 'sejarah'    ? 'selected' : '' }}>Sejarah</option>
                    <option value="visi_misi"  {{ old('tipe', $profil->tipe) == 'visi_misi'  ? 'selected' : '' }}>Visi & Misi</option>
                    <option value="fasilitas"  {{ old('tipe', $profil->tipe) == 'fasilitas'  ? 'selected' : '' }}>Fasilitas</option>
                    <option value="budaya"     {{ old('tipe', $profil->tipe) == 'budaya'     ? 'selected' : '' }}>Budaya</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="konten" class="block text-sm font-medium text-gray-700">Konten</label>
                <textarea
                    name="konten"
                    id="konten"
                    rows="6"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required
                >{{ old('konten', $profil->konten) }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Update</button>
        </form>
    </div>
    @endsection
