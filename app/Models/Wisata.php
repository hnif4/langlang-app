<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'lokasi',
        'jam_operasional',
        'kontak',        // <– tambahin ini kalau di migrasi ada
        'gambar',        // <– ini juga perlu kalau di database kamu pakai thumbnail utama
        'slug',
        'category_id',
        'harga_tiket',
    ];
    

    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
