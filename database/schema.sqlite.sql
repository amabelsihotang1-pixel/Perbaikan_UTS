CREATE TABLE IF NOT EXISTS motorcycles (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    brand TEXT NOT NULL CHECK (length(brand) <= 80),
    model TEXT NOT NULL CHECK (length(model) <= 100),
    category TEXT NOT NULL CHECK (category IN ('Matic', 'Sport', 'Bebek', 'Trail', 'Cruiser', 'Listrik')),
    model_year INTEGER NOT NULL CHECK (model_year >= 1990),
    engine_cc INTEGER NOT NULL DEFAULT 0 CHECK (engine_cc BETWEEN 0 AND 2500),
    color TEXT NOT NULL CHECK (length(color) <= 40),
    price NUMERIC NOT NULL DEFAULT 0 CHECK (price >= 0),
    stock INTEGER NOT NULL DEFAULT 0 CHECK (stock >= 0),
    location TEXT NOT NULL CHECK (length(location) <= 60),
    description TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_motorcycles_brand ON motorcycles (brand);
CREATE INDEX IF NOT EXISTS idx_motorcycles_model ON motorcycles (model);
CREATE INDEX IF NOT EXISTS idx_motorcycles_category ON motorcycles (category);
CREATE INDEX IF NOT EXISTS idx_motorcycles_updated_at ON motorcycles (updated_at);

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
