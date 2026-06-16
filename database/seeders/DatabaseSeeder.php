<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,      // ← Tambahin ini dulu (penting!)
            KatalogSeeder::class,   // Seeder katalog lo yang udah ada
            ArtikelSeeder::class,   // Seeder artikel lo yang udah ada
        ]);
    }
}