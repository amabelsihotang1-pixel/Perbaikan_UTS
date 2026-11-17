CREATE DATABASE IF NOT EXISTS garasi_roda
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE garasi_roda;

CREATE TABLE IF NOT EXISTS motorcycles (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    brand VARCHAR(80) NOT NULL,
    model VARCHAR(100) NOT NULL,
    category ENUM('Matic', 'Sport', 'Bebek', 'Trail', 'Cruiser', 'Listrik') NOT NULL,
    model_year SMALLINT UNSIGNED NOT NULL,
    engine_cc SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    color VARCHAR(40) NOT NULL,
    price DECIMAL(12, 2) UNSIGNED NOT NULL DEFAULT 0,
    stock INT UNSIGNED NOT NULL DEFAULT 0,
    location VARCHAR(60) NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_motorcycles_brand (brand),
    INDEX idx_motorcycles_model (model),
    INDEX idx_motorcycles_category (category),
    INDEX idx_motorcycles_updated_at (updated_at)
) ENGINE=InnoDB;

INSERT INTO motorcycles (brand, model, category, model_year, engine_cc, color, price, stock, location, description)
SELECT sample.*
FROM (
    SELECT 'Honda', 'Vario 160 ABS', 'Matic', 2025, 160, 'Grande Matte Red', 30750000, 4, 'Area Matic · Lantai 1', 'Skutik harian dengan ABS dan smart key. Surat kendaraan lengkap dan unit siap dikirim.'
    UNION ALL SELECT 'Yamaha', 'NMAX Neo S', 'Matic', 2025, 155, 'Elixir Dark Silver', 33950000, 3, 'Area Matic · Lantai 1', 'MAXi terbaru dengan Y-Connect dan posisi berkendara nyaman untuk perjalanan jauh.'
    UNION ALL SELECT 'Honda', 'CBR150R ABS', 'Sport', 2024, 150, 'Victory Black Red', 37750000, 2, 'Area Sport · Lantai 2', 'Motor sport fairing dengan assist slipper clutch dan rem ABS.'
    UNION ALL SELECT 'Kawasaki', 'KLX 150 SE', 'Trail', 2025, 144, 'Lime Green', 39900000, 1, 'Area Adventure · Halaman', 'Dual-purpose untuk jalur perkotaan dan petualangan akhir pekan.'
    UNION ALL SELECT 'Honda', 'Supra X 125 FI', 'Bebek', 2023, 125, 'Quantum Matte Black', 21800000, 5, 'Area Bebek · Lantai 1', 'Motor bebek irit dengan bagasi lega dan rem cakram depan.'
    UNION ALL SELECT 'Vespa', 'Primavera S 150', 'Cruiser', 2025, 150, 'Green Tenace', 59700000, 1, 'Area Premium · Lantai 2', 'Skuter ikonis bergaya klasik, dilengkapi lampu LED dan panel digital.'
    UNION ALL SELECT 'Polytron', 'Fox-R', 'Listrik', 2025, 0, 'Bumblebee Yellow', 20750000, 2, 'Area Elektrik · Lantai 1', 'Motor listrik dengan baterai sewa, konektivitas aplikasi, dan bagasi luas.'
    UNION ALL SELECT 'Yamaha', 'Fazzio Hybrid Neo', 'Matic', 2024, 125, 'Mint', 23175000, 6, 'Area Matic · Lantai 1', 'Skutik hybrid bergaya retro modern dengan ruang penyimpanan depan yang praktis.'
) AS sample
WHERE NOT EXISTS (SELECT 1 FROM motorcycles);
