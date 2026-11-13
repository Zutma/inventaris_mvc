<?php
require_once __DIR__ . '/../models/Barang.php';

class BarangController {
    private $model;

    public function __construct($conn) {
        $this->model = new Barang($conn);
    }

    public function index() {
        $pesan_error = "";
        $pesan_sukses = "";

        if (isset($_SESSION['sukses'])) {
            $pesan_sukses = $_SESSION['sukses'];
            unset($_SESSION['sukses']);
        }

        $id_edit = "";
        $kode_barang = "";
        $nama_barang = "";
        $kategori = "";
        $jumlah = "";
        $kondisi = "Baik";
        $tanggal_masuk = "";
        $keterangan = "";

        if (isset($_GET['hapus'])) {
            $id_hapus = (int) $_GET['hapus'];
            if ($this->model->delete($id_hapus)) {
                $_SESSION['sukses'] = "Data barang berhasil dihapus.";
            } else {
                $_SESSION['sukses'] = "Data barang gagal dihapus.";
            }
            header("Location: index.php");
            exit;
        }

        if (isset($_GET['edit'])) {
            $id = (int) $_GET['edit'];
            $data = $this->model->getById($id);
            if ($data) {
                $id_edit = $data['id'];
                $kode_barang = $data['kode_barang'];
                $nama_barang = $data['nama_barang'];
                $kategori = $data['kategori'];
                $jumlah = $data['jumlah'];
                $kondisi = $data['kondisi'];
                $tanggal_masuk = $data['tanggal_masuk'];
                $keterangan = $data['keterangan'];
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_edit = isset($_POST['id']) ? (int) $_POST['id'] : 0;
            $kode_barang = isset($_POST['kode_barang']) ? trim($_POST['kode_barang']) : "";
            $nama_barang = isset($_POST['nama_barang']) ? trim($_POST['nama_barang']) : "";
            $kategori = isset($_POST['kategori']) ? trim($_POST['kategori']) : "";
            $jumlah = isset($_POST['jumlah']) ? trim($_POST['jumlah']) : "";
            $kondisi = isset($_POST['kondisi']) ? trim($_POST['kondisi']) : "";
            $tanggal_masuk = isset($_POST['tanggal_masuk']) ? trim($_POST['tanggal_masuk']) : "";
            $keterangan = isset($_POST['keterangan']) ? trim($_POST['keterangan']) : "";

            $hari_ini = date('Y-m-d');

            if ($kode_barang == "" || $nama_barang == "") {
                $pesan_error = "Kode barang dan nama barang tidak boleh kosong atau hanya spasi.";
            } elseif (strlen($kode_barang) > 10) {
                $pesan_error = "Kode barang maksimal 10 karakter.";
            } elseif ($this->model->cekKodeUnik($kode_barang, $id_edit)) {
                $pesan_error = "Kode barang sudah terdaftar, gunakan kode lain.";
            } elseif ($kategori == "") {
                $pesan_error = "Kategori wajib dipilih.";
            } elseif ($jumlah === "" || !is_numeric($jumlah) || (int)$jumlah != $jumlah || (int)$jumlah < 0) {
                $pesan_error = "Jumlah harus berupa bilangan bulat minimal 0.";
            } elseif ($kondisi != "Baik" && $kondisi != "Rusak") {
                $pesan_error = "Kondisi wajib dipilih (Baik atau Rusak).";
            } elseif ($tanggal_masuk == "") {
                $pesan_error = "Tanggal masuk wajib diisi.";
            } elseif ($tanggal_masuk > $hari_ini) {
                $pesan_error = "Tanggal masuk tidak boleh di masa depan.";
            } else {
                $jumlah_int = (int) $jumlah;

                if ($id_edit > 0) {
                    $simpan = $this->model->update($id_edit, $kode_barang, $nama_barang, $kategori, $jumlah_int, $kondisi, $tanggal_masuk, $keterangan);
                    if ($simpan) {
                        $_SESSION['sukses'] = "Data barang berhasil diperbarui.";
                        header("Location: index.php");
                        exit;
                    } else {
                        $pesan_error = "Gagal memperbarui data barang.";
                    }
                } else {
                    $simpan = $this->model->insert($kode_barang, $nama_barang, $kategori, $jumlah_int, $kondisi, $tanggal_masuk, $keterangan);
                    if ($simpan) {
                        $_SESSION['sukses'] = "Data barang berhasil ditambahkan.";
                        header("Location: index.php");
                        exit;
                    } else {
                        $pesan_error = "Gagal menambahkan data barang.";
                    }
                }
            }

            if ($id_edit == 0) {
                $id_edit = "";
            }
        }

        $search = isset($_GET['search']) ? trim($_GET['search']) : "";
        $filter_kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : "";
        $filter_kondisi = isset($_GET['kondisi']) ? trim($_GET['kondisi']) : "";
        $tgl_dari = isset($_GET['tgl_dari']) ? trim($_GET['tgl_dari']) : "";
        $tgl_sampai = isset($_GET['tgl_sampai']) ? trim($_GET['tgl_sampai']) : "";

        $daftar_barang = $this->model->getAll($search, $filter_kategori, $filter_kondisi, $tgl_dari, $tgl_sampai);
        $statistik = $this->model->getStatistik();

        require __DIR__ . '/../views/index.php';
    }
}
?>