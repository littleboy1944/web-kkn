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
        Schema::create('rws', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rw'); // e.g. "RW 01", "RW 05"
            $table->string('nama'); // e.g. "RW 01 Kampung Kreatif"
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->text('potensi_kegiatan')->nullable();
            $table->string('foto_sampul')->nullable();
            $table->json('foto_galeri')->nullable();
            $table->string('nama_ketua_rw')->nullable();
            $table->string('kontak_ketua_rw')->nullable();
            $table->boolean('is_leader_public')->default(false); // Only displayed if permitted
            $table->enum('status', ['terbit', 'draf'])->default('terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rws');
    }
};
