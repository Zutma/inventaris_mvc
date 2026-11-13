CREATE DATABASE db_inventaris;
USE db_inventaris;

CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL UNIQUE,
    nama_barang VARCHAR(100) NOT NULL,
    kategori VARCHAR(30) NOT NULL,
    jumlah INT NOT NULL,
    kondisi VARCHAR(20) NOT NULL,
    tanggal_masuk DATE NOT NULL,
    keterangan TEXT
);

INSERT INTO barang (kode_barang, nama_barang, kategori, jumlah, kondisi, tanggal_masuk, keterangan) VALUES
('1', 'Proyektor', 'Elektronik', 2, 'Baik', '2026-11-01'),
('2', 'Meja', 'Furnitur', 5, 'Baik', '2026-11-05', ),
('3', 'Sapu', 'Kebersihan', 10, 'Rusak', '2026-11-10');