@extends('layouts.app')

@section('title', 'Tambah Profil Desa')

@section('content')

    <div class="container mx-auto py-6">
        <form action="{{ route('admin.profil-desa.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="judul" id="judul" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="tipe" class="block text-sm font-medium text-gray-700">Tipe</label>
                <select name="tipe" id="tipe" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="sejarah">Sejarah</option>
                    <option value="visi_misi">Visi & Misi</option>
                    <option value="wilayah">Wilayah</option>
                    <option value="fasilitas">Fasilitas</option>
                    <option value="budaya">Budaya</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="konten" class="block text-sm font-medium text-gray-700">Konten</label>
                <textarea name="konten" id="konten" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Simpan</button>
        </form>
    </div>
    @endsection
