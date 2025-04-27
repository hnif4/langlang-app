<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    use HasFactory;

    protected $table = 'umkms';

    protected $fillable = [
        'slug',
        'judul',
        'deskripsi',
        'harga',
        'kontak',
        'gambar',
        'category_id', 
    ];

    // Menambahkan relasi kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
