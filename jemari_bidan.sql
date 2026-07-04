SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `artikels`;

CREATE TABLE `artikels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `konten` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'umum',
  `dibaca` int NOT NULL DEFAULT '0',
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `artikels_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `artikels` VALUES (1,'Manfaat Pijat Bayi untuk Tumbuh Kembang','manfaat-pijat-bayi',NULL,'Pijat bayi memiliki banyak manfaat bagi tumbuh kembang si kecil. Selain meningkatkan ikatan emosional antara ibu dan bayi, pijat juga dapat melancarkan peredaran darah, meningkatkan sistem kekebalan tubuh, dan membantu bayi tidur lebih nyenyak...',NULL,'bayi',1241,1,'2026-06-16 06:13:51','2026-06-29 01:07:30'),(2,'Tips Menjaga Kesehatan Ibu Hamil Trimester 3','tips-ibu-hamil-trimester-3',NULL,'Trimester 3 adalah masa krusial dalam kehamilan. Ibu hamil perlu memperhatikan asupan gizi, istirahat yang cukup, dan persiapan persalinan. Konsumsi makanan kaya protein, kalsium, dan zat besi...',NULL,'ibu',894,1,'2026-06-16 06:13:51','2026-06-29 01:08:41'),(3,'Panduan Lengkap ASI Eksklusif untuk Bayi 0-6 Bulan','panduan-asi-eksklusif',NULL,'ASI eksklusif memberikan nutrisi terbaik untuk bayi. WHO merekomendasikan ASI eksklusif selama 6 bulan pertama kehidupan bayi. Artikel ini membahas teknik menyusui yang benar, posisi menyusui, dan cara mengatasi masalah ASI...',NULL,'gizi',2102,1,'2026-06-16 06:13:51','2026-06-29 01:08:48'),(4,'Tanda-Tanda Persalinan yang Perlu Diketahui','tanda-tanda-persalinan',NULL,'Mengenali tanda-tanda persalinan penting untuk persiapan melahirkan. Kontraksi yang teratur, pecah ketuban, dan show adalah tanda utama persalinan akan segera terjadi...',NULL,'ibu',1564,1,'2026-06-16 06:13:51','2026-06-29 01:08:43'),(5,'Cara Memandikan Bayi Baru Lahir yang Benar','cara-memandikan-bayi-baru-lahir',NULL,'Memandikan bayi baru lahir memerlukan teknik khusus. Pastikan suhu air hangat, gunakan washlap lembut, dan jangan lupa membersihkan lipatan kulit...',NULL,'bayi',3201,1,'2026-06-16 06:13:51','2026-06-29 01:08:12');

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` VALUES (1,'Risa','admin@jemaribidan.com','$2y$12$W5KJ.BRK6Tzi7juMWq.Zmur4JBjaj61YCKgOMDVC9f8VK0owkG.xS','082231627718','Surabaya, Jawa Timur','admin',NULL,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(2,'Fitri','fitri@example.com','$2y$12$u5qOFVpUibK/.LuGzOojCuEHzh0o7VAaVK4wYm4gmcc30mMHjdTaK','081234567890','Sidoarjo, Jawa Timur','user',NULL,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(3,'Shinta','shinta@example.com','$2y$12$95UrKAkrymQ5HGDeb2dcguHMsduTbPvrBmX0S2vdJ0MiAOTqlzBGy','089876543210','Gresik, Jawa Timur','user',NULL,'2026-06-16 06:13:51','2026-06-16 06:13:51');

DROP TABLE IF EXISTS `kategoris`;

CREATE TABLE `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategoris_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kategoris` VALUES (1,'Mom Treatment','mom','Perawatan ibu pasca melahirkan, bumil, dan pendampingan persalinan','images/galeri/mom.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(2,'Baby Treatment','baby','Perawatan bayi, toddler, dan anak dengan pendekatan lembut','images/galeri/baby.jpg',2,'2026-06-16 06:13:51','2026-06-16 06:13:51');

DROP TABLE IF EXISTS `pakets`;

CREATE TABLE `pakets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `harga` decimal(12,2) NOT NULL,
  `durasi` int NOT NULL DEFAULT '60',
  `fitur` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pakets_slug_unique` (`slug`),
  KEY `pakets_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `pakets_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pakets` VALUES (1,1,'Pijat Nifas','pijat-nifas','Pijat seluruh badan (kecuali perut) dengan durasi 60 menit',145000.00,60,'[\"Pijat Seluruh Badan (kecuali perut) 60 Menit\",\"Foot Soak Therapy\",\"Totok Wajah\",\"Cek Tekanan Darah\"]','paket/pijat-nifas.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(2,1,'Pijat Laktasi & Oksitosin','pijat-laktasi-oksitosin','Pijat khusus untuk melancarkan ASI',110000.00,45,'[\"Pijat Laktasi di area payudara untuk meningkatkan produksi ASI\",\"Pijat Oksitosin di area punggung untuk melancarkan pengeluaran ASI\",\"Kompres payudara\"]','paket/pijat-laktasi.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(3,1,'Calm Mom','calm-mom','Paket relax untuk ibu pasca melahirkan',160000.00,60,'[\"Pijat seluruh badan (kecuali perut) 60\'\",\"Foot soak therapy\",\"Totok wajah\",\"Face mask\",\"Cek tekanan darah\"]','paket/calm-mom.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(4,1,'Refresh Mom','refresh-mom','Paket refresh dengan body scrub',170000.00,60,'[\"Pijat seluruh badan (kecuali perut) 60\'\",\"Foot soak therapy\",\"Totok wajah\",\"Body scrub\",\"Cek tekanan darah\"]','paket/refresh-mom.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(5,1,'Relax Mom','relax-mom','Paket lengkap perawatan ibu',180000.00,60,'[\"Pijat seluruh badan (kecuali perut) 60\'\",\"Foot soak therapy\",\"Totok wajah\",\"Face mask\",\"Body scrub\",\"Cek tekanan darah\"]','paket/relax-mom.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(6,1,'Pijat Hamil Reguler','pijat-hamil-reguler','Pijatan lembut untuk ibu hamil',130000.00,60,'[\"Pijatan lembut di area kepala, leher, tangan dan kaki\",\"Durasi 60 menit\",\"Foot soak therapy\",\"Totok wajah\",\"Free cek detak jantung janin dan tekanan darah\"]','paket/pijat-hamil.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(7,1,'Pijat Induksi Persalinan & Prelaktasi','pijat-induksi','Pijatan khusus untuk persiapan persalinan',160000.00,60,'[\"Pijatan khusus pada kehamilan UK >36 minggu\",\"Tambahan pijatan pada titik-titik khusus\",\"Persiapan merangsang kontraksi dan produksi ASI\"]','paket/pijat-induksi.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(8,1,'Pretty Mom','pretty-mom','Paket perawatan ibu hamil',145000.00,60,'[\"Pijat hamil reguler 60\'\",\"Foot soak therapy\",\"Totok wajah\",\"Face mask\",\"Cek detak jantung janin\",\"Cek tekanan darah\"]','paket/pretty-mom.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(9,1,'Lovely Mom','lovely-mom','Paket lengkap dengan body scrub',155000.00,60,'[\"Pijat hamil reguler 60\'\",\"Foot soak therapy\",\"Totok wajah\",\"Body scrub\",\"Cek detak jantung janin\",\"Cek tekanan darah\"]','paket/lovely-mom.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(10,1,'Gorgeous Mom','gorgeous-mom','Paket premium perawatan ibu hamil',165000.00,60,'[\"Pijat hamil reguler 60\'\",\"Foot soak therapy\",\"Totok wajah\",\"Face mask\",\"Body scrub\",\"Cek detak jantung janin\",\"Cek tekanan darah\"]','paket/gorgeous-mom.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(11,1,'Copper Package','copper-package','Pendampingan persalinan basic',750000.00,0,'[\"Free prenatal yoga 1x\",\"Pendampingan selama persalinan hingga 2 jam postpartum\",\"Memfasilitasi teknik rebozo\",\"Pendampingan proses IMD\",\"Mental and physical birth support\"]','paket/copper.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(12,1,'Silver Package','silver-package','Pendampingan persalinan + newborn care',850000.00,0,'[\"Free prenatal yoga 1x\",\"Pendampingan selama persalinan hingga 2 jam postpartum\",\"Memfasilitasi teknik rebozo\",\"Pendampingan proses IMD\",\"Mental and physical birth support\",\"Free treatment newborn care (homecare)\"]','paket/silver.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(13,1,'Gold Package','gold-package','Pendampingan persalinan lengkap',1000000.00,0,'[\"Free pijat induksi dan prelaktasi 1x saat hamil (homecare)\",\"Free prenatal yoga 1x pertemuan\",\"Pendampingan selama persalinan hingga 2 jam postpartum\",\"Memfasilitasi teknik rebozo\",\"Pendampingan proses IMD\",\"Mental and physical birth support\",\"Free treatment newborn care (homecare)\",\"Voucher diskon 10% pijat laktasi dan oksitosin\"]','paket/gold.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(14,2,'Newborn Care 1x','newborn-1x','Perawatan bayi baru lahir 1 kali pertemuan',85000.00,45,'[\"Menjemur bayi\",\"Memandikan bayi\",\"Perawatan tali pusar\",\"Membersihkan lidah, mata dan telinga\",\"Simple baby massage\",\"KIE perawatan bayi baru lahir\",\"KIE laktasi\"]','paket/newborn-1x.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(15,2,'Paket Newborn 4 hari','newborn-4-hari','Perawatan bayi 4 hari berturut-turut',340000.00,45,'[\"Perawatan newborn care 4x\",\"Hemat dari harga normal Rp 340.000\"]','paket/newborn-4.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(16,2,'Paket Newborn 8 hari','newborn-8-hari','Perawatan bayi 8 hari + bonus cashback',640000.00,45,'[\"Perawatan newborn care 8x\",\"Bonus cashback 50% selapan half package\"]','paket/newborn-8.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(17,2,'Paket Newborn 14 hari','newborn-14-hari','Perawatan bayi 14 hari + free pijat nifas',1160000.00,45,'[\"Perawatan newborn care 14x\",\"Free pijat nifas reguler\"]','paket/newborn-14.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(18,2,'Baby Massage','baby-massage','Baby, Toddler & Kid Massage',60000.00,30,'[\"Usia 0-11 Bulan\",\"Minyak EVCO\",\"Full Body Massage\",\"Baby Gym\",\"Skrining Perkembangan\"]','paket/baby-massage.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(19,2,'Toddler Massage','toddler-massage','Massage untuk anak 1-3 tahun',70000.00,30,'[\"Usia 1-3 Tahun\",\"Minyak EVCO\",\"Full body massage\",\"Skrining perkembangan\"]','paket/toddler-massage.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(20,2,'Kid Massage','kid-massage','Massage untuk anak 4-7 tahun',80000.00,30,'[\"Usia 4-7 Tahun\",\"Minyak EVCO\",\"Full body massage\",\"Skrining perkembangan\"]','paket/kid-massage.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(21,2,'Paket Basic','massage-basic','Massage therapy untuk batuk & pilek',125000.00,45,'[\"Minyak EVCO\",\"Massage Therapy Bapil\",\"Nebul\\/Sinar Moksa (pilih salah satu)\",\"Skrining Perkembangan\"]','paket/massage-basic.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(22,2,'Paket Silver','massage-silver','Massage therapy + nebul + sinar moksa',150000.00,45,'[\"Minyak EVCO\",\"Massage Therapy Bapil\",\"Nebul\",\"Sinar Moksa\",\"Skrining Perkembangan\"]','paket/massage-silver.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(23,2,'Paket Gold','massage-gold','Massage therapy premium',165000.00,45,'[\"Minyak Extra Young Living\",\"Massage Therapy Bapil\",\"Nebul\",\"Sinar Moksa\",\"Skrining Perkembangan\"]','paket/massage-gold.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(24,2,'Half Package','selapan-half','Paket selapan basic',110000.00,60,'[\"Cukur gundul\",\"Baby gym & full body massage\",\"Bersihkan lidah\",\"Potong kuku\",\"Free skrining perkembangan\"]','paket/selapan-half.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(25,2,'Premium Package','selapan-premium','Paket selapan lengkap',250000.00,90,'[\"Cukur gundul\",\"Baby gym & full body massage\",\"Bersihkan lidah\",\"Potong kuku\",\"Memandikan bayi\",\"Pijat nifas reguler\",\"Free skrining perkembangan\"]','paket/selapan-premium.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51'),(26,2,'Full Package','selapan-full','Paket selapan lengkap',130000.00,60,'[\"Cukur gundul\",\"Baby gym & full body massage\",\"Bersihkan lidah\",\"Potong kuku\",\"Memandikan bayi\",\"Free skrining perkembangan\"]','paket/selapan-full.jpg',1,'2026-06-16 06:13:51','2026-06-16 06:13:51');

DROP TABLE IF EXISTS `transaksis`;

CREATE TABLE `transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `status` enum('menunggu','diproses','selesai','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `tanggal_transaksi` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaksis_kode_transaksi_unique` (`kode_transaksi`),
  KEY `transaksis_user_id_foreign` (`user_id`),
  CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transaksis` VALUES (1,3,'TRX-20260616-PAG',80000.00,'selesai',NULL,'2026-06-16 07:12:18','2026-06-16 07:12:18','2026-06-17 01:47:46'),(2,2,'TRX-20260617-DZ0',180000.00,'dibatalkan','akdfj ajdflkajf','2026-06-17 01:46:46','2026-06-17 01:46:46','2026-06-17 01:48:01'),(3,3,'TRX-20260629-MK4',160000.00,'selesai',NULL,'2026-06-29 01:12:49','2026-06-29 01:12:49','2026-06-29 01:16:47'),(4,2,'TRX-20260629-FUP',85000.00,'menunggu',NULL,'2026-06-29 01:33:46','2026-06-29 01:33:46','2026-06-29 01:33:46');

DROP TABLE IF EXISTS `detail_transaksis`;

CREATE TABLE `detail_transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint unsigned NOT NULL,
  `paket_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL,
  `harga_satuan` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_transaksis_transaksi_id_foreign` (`transaksi_id`),
  KEY `detail_transaksis_paket_id_foreign` (`paket_id`),
  CONSTRAINT `detail_transaksis_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`),
  CONSTRAINT `detail_transaksis_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `detail_transaksis` VALUES (1,1,20,1,80000.00,80000.00,'2026-06-16 07:12:18','2026-06-16 07:12:18'),(2,2,5,1,180000.00,180000.00,'2026-06-17 01:46:46','2026-06-17 01:46:46'),(3,3,3,1,160000.00,160000.00,'2026-06-29 01:12:49','2026-06-29 01:12:49'),(4,4,14,1,85000.00,85000.00,'2026-06-29 01:33:46','2026-06-29 01:33:46');

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `keranjangs`;

CREATE TABLE `keranjangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_13_041921_create_produks_table',1),(5,'2026_06_13_041930_create_kategoris_table',1),(6,'2026_06_13_041940_create_transaksis_table',1),(7,'2026_06_13_042002_create_artikels_table',1),(8,'2026_06_13_042008_create_keranjangs_table',1);

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `produks`;

CREATE TABLE `produks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
