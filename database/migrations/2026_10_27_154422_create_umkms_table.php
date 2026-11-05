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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rw_id')->constrained('rws')->cascadeOnDelete();
            $table->string('nama_usaha');
            $table->string('slug')->unique();
            $table->string('kategori'); // Makanan & Minuman, Kerajinan Tangan, Pertanian & Perkebunan, Fesyen, Jasa, dll.
            $table->string('nama_pemilik')->nullable();
            $table->boolean('is_owner_public')->default(false);
            $table->text('deskripsi')->nullable();
            $table->string('foto_sampul')->nullable();
            $table->json('foto_galeri')->nullable();
            $table->string('nomor_whatsapp')->nullable(); // stored normalized: 628...
            $table->text('pesan_whatsapp_template')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('tautan_sosmed')->nullable(); // e.g. Instagram / social URL
            $table->string('alamat_spesifik')->nullable();
            $table->boolean('is_unggulan')->default(false);
            $table->enum('status', ['terbit', 'draf'])->default('terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
