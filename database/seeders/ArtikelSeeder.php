<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $artikels = [
            [
                'judul' => 'Manfaat Pijat Bayi untuk Tumbuh Kembang',
                'slug' => 'manfaat-pijat-bayi',
                'konten' => 'Pijat bayi memiliki banyak manfaat bagi tumbuh kembang si kecil. Selain meningkatkan ikatan emosional antara ibu dan bayi, pijat juga dapat melancarkan peredaran darah, meningkatkan sistem kekebalan tubuh, dan membantu bayi tidur lebih nyenyak...',
                'kategori' => 'bayi',
                'dibaca' => 1240,
            ],
            [
                'judul' => 'Tips Menjaga Kesehatan Ibu Hamil Trimester 3',
                'slug' => 'tips-ibu-hamil-trimester-3',
                'konten' => 'Trimester 3 adalah masa krusial dalam kehamilan. Ibu hamil perlu memperhatikan asupan gizi, istirahat yang cukup, dan persiapan persalinan. Konsumsi makanan kaya protein, kalsium, dan zat besi...',
                'kategori' => 'ibu',
                'dibaca' => 890,
            ],
            [
                'judul' => 'Panduan Lengkap ASI Eksklusif untuk Bayi 0-6 Bulan',
                'slug' => 'panduan-asi-eksklusif',
                'konten' => 'ASI eksklusif memberikan nutrisi terbaik untuk bayi. WHO merekomendasikan ASI eksklusif selama 6 bulan pertama kehidupan bayi. Artikel ini membahas teknik menyusui yang benar, posisi menyusui, dan cara mengatasi masalah ASI...',
                'kategori' => 'gizi',
                'dibaca' => 2100,
            ],
            [
                'judul' => 'Tanda-Tanda Persalinan yang Perlu Diketahui',
                'slug' => 'tanda-tanda-persalinan',
                'konten' => 'Mengenali tanda-tanda persalinan penting untuk persiapan melahirkan. Kontraksi yang teratur, pecah ketuban, dan show adalah tanda utama persalinan akan segera terjadi...',
                'kategori' => 'ibu',
                'dibaca' => 1560,
            ],
            [
                'judul' => 'Cara Memandikan Bayi Baru Lahir yang Benar',
                'slug' => 'cara-memandikan-bayi-baru-lahir',
                'konten' => 'Memandikan bayi baru lahir memerlukan teknik khusus. Pastikan suhu air hangat, gunakan washlap lembut, dan jangan lupa membersihkan lipatan kulit...',
                'kategori' => 'bayi',
                'dibaca' => 3200,
            ],
        ];

        foreach ($artikels as $artikel) {
            Artikel::create($artikel);
        }
    }
}