<?php
// database/seeders/KatalogSeeder.php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Paket;
use Illuminate\Database\Seeder;

class KatalogSeeder extends Seeder
{
    public function run(): void
    {
        // === MOM TREATMENT ===
        $mom = Kategori::create([
            'nama' => 'Mom Treatment',
            'slug' => 'mom',
            'deskripsi' => 'Perawatan ibu pasca melahirkan, bumil, dan pendampingan persalinan',
            'gambar' => 'kategori/mom.jpg',
            'urutan' => 1,
        ]);

        // Mom Treatment Pasca Melahirkan
        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Pijat Nifas',
            'slug' => 'pijat-nifas',
            'deskripsi' => 'Pijat seluruh badan (kecuali perut) dengan durasi 60 menit',
            'harga' => 145000,
            'durasi' => 60,
            'fitur' => [
                'Pijat Seluruh Badan (kecuali perut) 60 Menit',
                'Foot Soak Therapy',
                'Totok Wajah',
                'Cek Tekanan Darah',
            ],
            'gambar' => 'paket/pijat-nifas.jpg',
        ]);

        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Pijat Laktasi & Oksitosin',
            'slug' => 'pijat-laktasi-oksitosin',
            'deskripsi' => 'Pijat khusus untuk melancarkan ASI',
            'harga' => 110000,
            'durasi' => 45,
            'fitur' => [
                'Pijat Laktasi di area payudara untuk meningkatkan produksi ASI',
                'Pijat Oksitosin di area punggung untuk melancarkan pengeluaran ASI',
                'Kompres payudara',
            ],
            'gambar' => 'paket/pijat-laktasi.jpg',
        ]);

        // Mom Treatment Package
        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Calm Mom',
            'slug' => 'calm-mom',
            'deskripsi' => 'Paket relax untuk ibu pasca melahirkan',
            'harga' => 160000,
            'durasi' => 60,
            'fitur' => [
                'Pijat seluruh badan (kecuali perut) 60\'',
                'Foot soak therapy',
                'Totok wajah',
                'Face mask',
                'Cek tekanan darah',
            ],
            'gambar' => 'paket/calm-mom.jpg',
        ]);

        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Refresh Mom',
            'slug' => 'refresh-mom',
            'deskripsi' => 'Paket refresh dengan body scrub',
            'harga' => 170000,
            'durasi' => 60,
            'fitur' => [
                'Pijat seluruh badan (kecuali perut) 60\'',
                'Foot soak therapy',
                'Totok wajah',
                'Body scrub',
                'Cek tekanan darah',
            ],
            'gambar' => 'paket/refresh-mom.jpg',
        ]);

        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Relax Mom',
            'slug' => 'relax-mom',
            'deskripsi' => 'Paket lengkap perawatan ibu',
            'harga' => 180000,
            'durasi' => 60,
            'fitur' => [
                'Pijat seluruh badan (kecuali perut) 60\'',
                'Foot soak therapy',
                'Totok wajah',
                'Face mask',
                'Body scrub',
                'Cek tekanan darah',
            ],
            'gambar' => 'paket/relax-mom.jpg',
        ]);

        // Bumil Treatment
        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Pijat Hamil Reguler',
            'slug' => 'pijat-hamil-reguler',
            'deskripsi' => 'Pijatan lembut untuk ibu hamil',
            'harga' => 130000,
            'durasi' => 60,
            'fitur' => [
                'Pijatan lembut di area kepala, leher, tangan dan kaki',
                'Durasi 60 menit',
                'Foot soak therapy',
                'Totok wajah',
                'Free cek detak jantung janin dan tekanan darah',
            ],
            'gambar' => 'paket/pijat-hamil.jpg',
        ]);

        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Pijat Induksi Persalinan & Prelaktasi',
            'slug' => 'pijat-induksi',
            'deskripsi' => 'Pijatan khusus untuk persiapan persalinan',
            'harga' => 160000,
            'durasi' => 60,
            'fitur' => [
                'Pijatan khusus pada kehamilan UK >36 minggu',
                'Tambahan pijatan pada titik-titik khusus',
                'Persiapan merangsang kontraksi dan produksi ASI',
            ],
            'gambar' => 'paket/pijat-induksi.jpg',
        ]);

        // Bumil Package
        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Pretty Mom',
            'slug' => 'pretty-mom',
            'deskripsi' => 'Paket perawatan ibu hamil',
            'harga' => 145000,
            'durasi' => 60,
            'fitur' => [
                'Pijat hamil reguler 60\'',
                'Foot soak therapy',
                'Totok wajah',
                'Face mask',
                'Cek detak jantung janin',
                'Cek tekanan darah',
            ],
            'gambar' => 'paket/pretty-mom.jpg',
        ]);

        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Lovely Mom',
            'slug' => 'lovely-mom',
            'deskripsi' => 'Paket lengkap dengan body scrub',
            'harga' => 155000,
            'durasi' => 60,
            'fitur' => [
                'Pijat hamil reguler 60\'',
                'Foot soak therapy',
                'Totok wajah',
                'Body scrub',
                'Cek detak jantung janin',
                'Cek tekanan darah',
            ],
            'gambar' => 'paket/lovely-mom.jpg',
        ]);

        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Gorgeous Mom',
            'slug' => 'gorgeous-mom',
            'deskripsi' => 'Paket premium perawatan ibu hamil',
            'harga' => 165000,
            'durasi' => 60,
            'fitur' => [
                'Pijat hamil reguler 60\'',
                'Foot soak therapy',
                'Totok wajah',
                'Face mask',
                'Body scrub',
                'Cek detak jantung janin',
                'Cek tekanan darah',
            ],
            'gambar' => 'paket/gorgeous-mom.jpg',
        ]);

        // Pendampingan Persalinan
        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Copper Package',
            'slug' => 'copper-package',
            'deskripsi' => 'Pendampingan persalinan basic',
            'harga' => 750000,
            'durasi' => 0,
            'fitur' => [
                'Free prenatal yoga 1x',
                'Pendampingan selama persalinan hingga 2 jam postpartum',
                'Memfasilitasi teknik rebozo',
                'Pendampingan proses IMD',
                'Mental and physical birth support',
            ],
            'gambar' => 'paket/copper.jpg',
        ]);

        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Silver Package',
            'slug' => 'silver-package',
            'deskripsi' => 'Pendampingan persalinan + newborn care',
            'harga' => 850000,
            'durasi' => 0,
            'fitur' => [
                'Free prenatal yoga 1x',
                'Pendampingan selama persalinan hingga 2 jam postpartum',
                'Memfasilitasi teknik rebozo',
                'Pendampingan proses IMD',
                'Mental and physical birth support',
                'Free treatment newborn care (homecare)',
            ],
            'gambar' => 'paket/silver.jpg',
        ]);

        Paket::create([
            'kategori_id' => $mom->id,
            'nama' => 'Gold Package',
            'slug' => 'gold-package',
            'deskripsi' => 'Pendampingan persalinan lengkap',
            'harga' => 1000000,
            'durasi' => 0,
            'fitur' => [
                'Free pijat induksi dan prelaktasi 1x saat hamil (homecare)',
                'Free prenatal yoga 1x pertemuan',
                'Pendampingan selama persalinan hingga 2 jam postpartum',
                'Memfasilitasi teknik rebozo',
                'Pendampingan proses IMD',
                'Mental and physical birth support',
                'Free treatment newborn care (homecare)',
                'Voucher diskon 10% pijat laktasi dan oksitosin',
            ],
            'gambar' => 'paket/gold.jpg',
        ]);

        // === BABY TREATMENT ===
        $baby = Kategori::create([
            'nama' => 'Baby Treatment',
            'slug' => 'baby',
            'deskripsi' => 'Perawatan bayi, toddler, dan anak dengan pendekatan lembut',
            'gambar' => 'kategori/baby.jpg',
            'urutan' => 2,
        ]);

        // Newborn Care
        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Newborn Care 1x',
            'slug' => 'newborn-1x',
            'deskripsi' => 'Perawatan bayi baru lahir 1 kali pertemuan',
            'harga' => 85000,
            'durasi' => 45,
            'fitur' => [
                'Menjemur bayi',
                'Memandikan bayi',
                'Perawatan tali pusar',
                'Membersihkan lidah, mata dan telinga',
                'Simple baby massage',
                'KIE perawatan bayi baru lahir',
                'KIE laktasi',
            ],
            'gambar' => 'paket/newborn-1x.jpg',
        ]);

        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Paket Newborn 4 hari',
            'slug' => 'newborn-4-hari',
            'deskripsi' => 'Perawatan bayi 4 hari berturut-turut',
            'harga' => 340000,
            'durasi' => 45,
            'fitur' => [
                'Perawatan newborn care 4x',
                'Hemat dari harga normal Rp 340.000',
            ],
            'gambar' => 'paket/newborn-4.jpg',
        ]);

        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Paket Newborn 8 hari',
            'slug' => 'newborn-8-hari',
            'deskripsi' => 'Perawatan bayi 8 hari + bonus cashback',
            'harga' => 640000,
            'durasi' => 45,
            'fitur' => [
                'Perawatan newborn care 8x',
                'Bonus cashback 50% selapan half package',
            ],
            'gambar' => 'paket/newborn-8.jpg',
        ]);

        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Paket Newborn 14 hari',
            'slug' => 'newborn-14-hari',
            'deskripsi' => 'Perawatan bayi 14 hari + free pijat nifas',
            'harga' => 1160000,
            'durasi' => 45,
            'fitur' => [
                'Perawatan newborn care 14x',
                'Free pijat nifas reguler',
            ],
            'gambar' => 'paket/newborn-14.jpg',
        ]);

        // Baby Massage
        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Baby Massage',
            'slug' => 'baby-massage',
            'deskripsi' => 'Baby, Toddler & Kid Massage',
            'harga' => 60000,
            'durasi' => 30,
            'fitur' => [
                'Usia 0-11 Bulan',
                'Minyak EVCO',
                'Full Body Massage',
                'Baby Gym',
                'Skrining Perkembangan',
            ],
            'gambar' => 'paket/baby-massage.jpg',
        ]);

        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Toddler Massage',
            'slug' => 'toddler-massage',
            'deskripsi' => 'Massage untuk anak 1-3 tahun',
            'harga' => 70000,
            'durasi' => 30,
            'fitur' => [
                'Usia 1-3 Tahun',
                'Minyak EVCO',
                'Full body massage',
                'Skrining perkembangan',
            ],
            'gambar' => 'paket/toddler-massage.jpg',
        ]);

        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Kid Massage',
            'slug' => 'kid-massage',
            'deskripsi' => 'Massage untuk anak 4-7 tahun',
            'harga' => 80000,
            'durasi' => 30,
            'fitur' => [
                'Usia 4-7 Tahun',
                'Minyak EVCO',
                'Full body massage',
                'Skrining perkembangan',
            ],
            'gambar' => 'paket/kid-massage.jpg',
        ]);

        // Massage Therapy Batuk & Pilek
        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Paket Basic',
            'slug' => 'massage-basic',
            'deskripsi' => 'Massage therapy untuk batuk & pilek',
            'harga' => 125000,
            'durasi' => 45,
            'fitur' => [
                'Minyak EVCO',
                'Massage Therapy Bapil',
                'Nebul/Sinar Moksa (pilih salah satu)',
                'Skrining Perkembangan',
            ],
            'gambar' => 'paket/massage-basic.jpg',
        ]);

        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Paket Silver',
            'slug' => 'massage-silver',
            'deskripsi' => 'Massage therapy + nebul + sinar moksa',
            'harga' => 150000,
            'durasi' => 45,
            'fitur' => [
                'Minyak EVCO',
                'Massage Therapy Bapil',
                'Nebul',
                'Sinar Moksa',
                'Skrining Perkembangan',
            ],
            'gambar' => 'paket/massage-silver.jpg',
        ]);

        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Paket Gold',
            'slug' => 'massage-gold',
            'deskripsi' => 'Massage therapy premium',
            'harga' => 165000,
            'durasi' => 45,
            'fitur' => [
                'Minyak Extra Young Living',
                'Massage Therapy Bapil',
                'Nebul',
                'Sinar Moksa',
                'Skrining Perkembangan',
            ],
            'gambar' => 'paket/massage-gold.jpg',
        ]);

        // Paket Selapan
        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Half Package',
            'slug' => 'selapan-half',
            'deskripsi' => 'Paket selapan basic',
            'harga' => 110000,
            'durasi' => 60,
            'fitur' => [
                'Cukur gundul',
                'Baby gym & full body massage',
                'Bersihkan lidah',
                'Potong kuku',
                'Free skrining perkembangan',
            ],
            'gambar' => 'paket/selapan-half.jpg',
        ]);

        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Premium Package',
            'slug' => 'selapan-premium',
            'deskripsi' => 'Paket selapan lengkap',
            'harga' => 250000,
            'durasi' => 90,
            'fitur' => [
                'Cukur gundul',
                'Baby gym & full body massage',
                'Bersihkan lidah',
                'Potong kuku',
                'Memandikan bayi',
                'Pijat nifas reguler',
                'Free skrining perkembangan',
            ],
            'gambar' => 'paket/selapan-premium.jpg',
        ]);

        Paket::create([
            'kategori_id' => $baby->id,
            'nama' => 'Full Package',
            'slug' => 'selapan-full',
            'deskripsi' => 'Paket selapan lengkap',
            'harga' => 130000,
            'durasi' => 60,
            'fitur' => [
                'Cukur gundul',
                'Baby gym & full body massage',
                'Bersihkan lidah',
                'Potong kuku',
                'Memandikan bayi',
                'Free skrining perkembangan',
            ],
            'gambar' => 'paket/selapan-full.jpg',
        ]);
    }
}