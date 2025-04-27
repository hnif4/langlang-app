<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('wisatas', function (Blueprint $table) {
        $table->id();
        $table->string('slug')->unique();
        $table->string('judul');
        $table->string('gambar')->nullable(); // thumbnail utama
        $table->text('deskripsi');
        $table->string('lokasi'); // alamat atau nama tempat
        $table->string('kontak')->nullable(); // bisa nomor WA, email, dll
        $table->string('jam_operasional')->nullable(); // opsional
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisatas');
    }
};
