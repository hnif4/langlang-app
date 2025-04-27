<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'judul',
        'konten',
        'category_id',
        'gambar',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
