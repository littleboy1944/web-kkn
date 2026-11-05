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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori'); // Kisah UMKM, Kegiatan Warga, Potensi Wilayah, dll.
            $table->text('ringkasan')->nullable();
            $table->longText('konten')->nullable();
            $table->string('foto_sampul')->nullable();
            $table->date('tanggal_publikasi')->nullable();
            $table->enum('status', ['terbit', 'draf', 'terjadwal'])->default('terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
