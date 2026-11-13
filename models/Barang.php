<?php
class Barang {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll($search, $kategori, $kondisi, $tgl_dari, $tgl_sampai) {
        $sql = "SELECT * FROM barang WHERE 1=1";
        $params = array();
        $types = "";

        if ($search != "") {
            $sql .= " AND nama_barang LIKE ?";
            $params[] = "%" . $search . "%";
            $types .= "s";
        }

        if ($kategori != "") {
            $sql .= " AND kategori = ?";
            $params[] = $kategori;
            $types .= "s";
        }

        if ($kondisi != "") {
            $sql .= " AND kondisi = ?";
            $params[] = $kondisi;
            $types .= "s";
        }

        if ($tgl_dari != "") {
            $sql .= " AND tanggal_masuk >= ?";
            $params[] = $tgl_dari;
            $types .= "s";
        }

        if ($tgl_sampai != "") {
            $sql .= " AND tanggal_masuk <= ?";
            $params[] = $tgl_sampai;
            $types .= "s";
        }

        $sql .= " ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        if (count($params) > 0) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM barang WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function cekKodeUnik($kode, $id_edit) {
        if ($id_edit > 0) {
            $stmt = $this->conn->prepare("SELECT id FROM barang WHERE kode_barang = ? AND id != ?");
            $stmt->bind_param("si", $kode, $id_edit);
        } else {
            $stmt = $this->conn->prepare("SELECT id FROM barang WHERE kode_barang = ?");
            $stmt->bind_param("s", $kode);
        }
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function insert($kode, $nama, $kategori, $jumlah, $kondisi, $tanggal, $keterangan) {
        $stmt = $this->conn->prepare("INSERT INTO barang (kode_barang, nama_barang, kategori, jumlah, kondisi, tanggal_masuk, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $kode, $nama, $kategori, $jumlah, $kondisi, $tanggal, $keterangan);
        return $stmt->execute();
    }

    public function update($id, $kode, $nama, $kategori, $jumlah, $kondisi, $tanggal, $keterangan) {
        $stmt = $this->conn->prepare("UPDATE barang SET kode_barang = ?, nama_barang = ?, kategori = ?, jumlah = ?, kondisi = ?, tanggal_masuk = ?, keterangan = ? WHERE id = ?");
        $stmt->bind_param("sssisssi", $kode, $nama, $kategori, $jumlah, $kondisi, $tanggal, $keterangan, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getStatistik() {
        $sql = "SELECT 
                    COUNT(*) AS jenis_barang,
                    COALESCE(SUM(jumlah), 0) AS total_unit,
                    COALESCE(SUM(CASE WHEN kondisi = 'Baik' THEN jumlah ELSE 0 END), 0) AS unit_baik,
                    COALESCE(SUM(CASE WHEN kondisi = 'Rusak' THEN jumlah ELSE 0 END), 0) AS unit_rusak
                FROM barang";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
?>