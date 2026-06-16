<?php
// database/migrations/2024_06_14_000001_create_kategoris_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel kategori (Mom / Baby)
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');           // "Mom Treatment" / "Baby Treatment"
            $table->string('slug')->unique();   // "mom" / "baby"
            $table->string('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Tabel paket (Calm Mom, Refresh Mom, dll)
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('nama');             // "Calm Mom", "Paket Basic"
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 12, 2);
            $table->integer('durasi')->default(60); // menit
            $table->text('fitur')->nullable();  // JSON array fitur
            $table->string('gambar')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pakets');
        Schema::dropIfExists('kategoris');
    }
};