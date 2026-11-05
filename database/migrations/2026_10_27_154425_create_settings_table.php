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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_website')->default('Direktori RW & UMKM');
            $table->string('tagline')->default('Mengenal Rukun Warga & Merayakan Ragam Usaha Lokal');
            $table->text('deskripsi_singkat')->nullable();
            $table->string('logo')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('kontak_email')->nullable();
            $table->string('kontak_telepon')->nullable();
            $table->text('alamat_sekretariat')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('warna_aksen')->default('#14382c');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
