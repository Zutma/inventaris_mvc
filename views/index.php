<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Inventaris Kelas</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; background-color: #f8fafc; color: #1e293b;">

<div style="width: 100%; max-width: 1100px; margin: 0 auto; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">

    <h1 style="color: #1e3a8a; margin-top: 0; text-align: center;">Sistem Inventaris Kelas</h1>
    <hr style="border: 0; border-top: 1px solid #cbd5e1; margin-bottom: 20px;">

    <?php if ($pesan_sukses != ""): ?>
        <p style="background: #ecfdf5; color: #065f46; padding: 12px; border: 1px solid #a7f3d0; border-radius: 4px;">
            <b>BERHASIL: <?= htmlspecialchars($pesan_sukses) ?></b>
        </p>
    <?php endif; ?>

    <?php if ($pesan_error != ""): ?>
        <p style="background: #fef2f2; color: #991b1b; padding: 12px; border: 1px solid #fecaca; border-radius: 4px;">
            <b>GAGAL: <?= htmlspecialchars($pesan_error) ?></b>
        </p>
    <?php endif; ?>

    <h3 style="color: #334155;">Ringkasan Statistik</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: center; margin-bottom: 25px; border-color: #cbd5e1;">
        <tr style="background: #e2e8f0; color: #1e293b;">
            <th>Jumlah Jenis Barang</th>
            <th>Total Unit</th>
            <th>Unit Kondisi Baik</th>
            <th>Unit Kondisi Rusak</th>
        </tr>
        <tr>
            <td style="color: #2563eb; font-size: 18px;"><b><?= $statistik['jenis_barang'] ?></b></td>
            <td style="color: #475569; font-size: 18px;"><b><?= $statistik['total_unit'] ?></b></td>
            <td style="color: #16a34a; font-size: 18px;"><b><?= $statistik['unit_baik'] ?></b></td>
            <td style="color: #dc2626; font-size: 18px;"><b><?= $statistik['unit_rusak'] ?></b></td>
        </tr>
    </table>

    <!-- <hr style="border: 0; border-top: 1px solid #cbd5e1; margin-bottom: 20px;"> -->

    <h3 style="color: #334155;"><?= ($id_edit != "") ? "Edit Data Barang" : "Tambah Data Barang" ?></h3>
    <form method="POST" action="index.php" style="margin-bottom: 25px; background: #f1f5f9; padding: 20px; border: 1px solid #e2e8f0; border-radius: 6px;">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id_edit) ?>">

        <div style="margin-bottom: 12px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Kode Barang</label>
            <input type="text" name="kode_barang" maxlength="10" value="<?= htmlspecialchars($kode_barang) ?>" style="padding: 7px; width: 320px; border: 1px solid #cbd5e1; border-radius: 4px;" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Nama Barang</label>
            <input type="text" name="nama_barang" maxlength="100" value="<?= htmlspecialchars($nama_barang) ?>" style="padding: 7px; width: 320px; border: 1px solid #cbd5e1; border-radius: 4px;" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Kategori</label>
            <select name="kategori" style="padding: 7px; width: 336px; border: 1px solid #cbd5e1; border-radius: 4px;" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Elektronik" <?= ($kategori == "Elektronik") ? "selected" : "" ?>>Elektronik</option>
                <option value="Furnitur" <?= ($kategori == "Furnitur") ? "selected" : "" ?>>Furnitur</option>
                <option value="Alat Tulis" <?= ($kategori == "Alat Tulis") ? "selected" : "" ?>>Alat Tulis</option>
                <option value="Kebersihan" <?= ($kategori == "Kebersihan") ? "selected" : "" ?>>Kebersihan</option>
                <option value="Lainnya" <?= ($kategori == "Lainnya") ? "selected" : "" ?>>Lainnya</option>
            </select>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Jumlah</label>
            <input type="number" name="jumlah" min="0" value="<?= htmlspecialchars($jumlah) ?>" style="padding: 7px; width: 320px; border: 1px solid #cbd5e1; border-radius: 4px;" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Kondisi</label>
            <label style="cursor: pointer; margin-right: 15px;"><input type="radio" name="kondisi" value="Baik" <?= ($kondisi == "Baik") ? "checked" : "" ?>> Baik</label>
            <label style="cursor: pointer;"><input type="radio" name="kondisi" value="Rusak" <?= ($kondisi == "Rusak") ? "checked" : "" ?>> Rusak</label>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" value="<?= htmlspecialchars($tanggal_masuk) ?>" style="padding: 7px; width: 320px; border: 1px solid #cbd5e1; border-radius: 4px;" required>
        </div>

        <div style="margin-bottom: 14px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569; vertical-align: top;">Keterangan (Opsional)</label>
            <textarea name="keterangan" rows="3" style="padding: 7px; width: 320px; border: 1px solid #cbd5e1; border-radius: 4px;"><?= htmlspecialchars($keterangan) ?></textarea>
        </div>

        <div style="margin-left: 164px;">
            <button type="submit" style="padding: 8px 18px; background: #2563eb; color: #ffffff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;"><?= ($id_edit != "") ? "Update" : "Submit" ?></button>
            <a href="index.php" style="text-decoration: none;"><button type="button" style="padding: 8px 18px; background: #64748b; color: #ffffff; border: none; border-radius: 4px; cursor: pointer;">Reset</button></a>
            <?php if ($id_edit != ""): ?>
                <a href="index.php" style="text-decoration: none;"><button type="button" style="padding: 8px 18px; background: #ef4444; color: #ffffff; border: none; border-radius: 4px; cursor: pointer; margin-left: 5px;">Batal Edit</button></a>
            <?php endif; ?>
        </div>
    </form>

    <!-- <hr style="border: 0; border-top: 1px solid #cbd5e1; margin-bottom: 20px;"> -->

    <h3 style="color: #334155;">Pencarian & Filter</h3>
    <form method="GET" action="index.php" style="background: #f1f5f9; padding: 20px; border: 1px solid #cbd5e1; border-radius: 6px; margin-bottom: 25px;">
        <div style="margin-bottom: 12px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Nama Barang</label>
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari nama barang..." style="padding: 7px; width: 320px; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Kategori</label>
            <select name="kategori" style="padding: 7px; width: 336px; border: 1px solid #cbd5e1; border-radius: 4px;">
                <option value="">Semua Kategori</option>
                <option value="Elektronik" <?= ($filter_kategori == "Elektronik") ? "selected" : "" ?>>Elektronik</option>
                <option value="Furnitur" <?= ($filter_kategori == "Furnitur") ? "selected" : "" ?>>Furnitur</option>
                <option value="Alat Tulis" <?= ($filter_kategori == "Alat Tulis") ? "selected" : "" ?>>Alat Tulis</option>
                <option value="Kebersihan" <?= ($filter_kategori == "Kebersihan") ? "selected" : "" ?>>Kebersihan</option>
                <option value="Lainnya" <?= ($filter_kategori == "Lainnya") ? "selected" : "" ?>>Lainnya</option>
            </select>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Kondisi</label>
            <select name="kondisi" style="padding: 7px; width: 336px; border: 1px solid #cbd5e1; border-radius: 4px;">
                <option value="">Semua Kondisi</option>
                <option value="Baik" <?= ($filter_kondisi == "Baik") ? "selected" : "" ?>>Baik</option>
                <option value="Rusak" <?= ($filter_kondisi == "Rusak") ? "selected" : "" ?>>Rusak</option>
            </select>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Dari Tanggal</label>
            <input type="date" name="tgl_dari" value="<?= htmlspecialchars($tgl_dari) ?>" style="padding: 7px; width: 320px; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: inline-block; width: 160px; font-weight: bold; color: #475569;">Sampai Tanggal</label>
            <input type="date" name="tgl_sampai" value="<?= htmlspecialchars($tgl_sampai) ?>" style="padding: 7px; width: 320px; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-left: 164px;">
            <button type="submit" style="padding: 8px 18px; background: #2563eb; color: #ffffff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Cari / Filter</button>
            <a href="index.php" style="text-decoration: none;"><button type="button" style="padding: 8px 18px; background: #64748b; color: #ffffff; border: none; border-radius: 4px; cursor: pointer; margin-left: 5px;">Reset Filter</button></a>
        </div>
    </form>

    <h3 style="color: #334155;">Daftar Inventaris Barang</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; border-color: #cbd5e1;">
        <tr style="background: #e2e8f0; color: #1e293b; text-align: left;">
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Kondisi</th>
            <th>Tanggal Masuk</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        <?php if (count($daftar_barang) == 0): ?>
            <tr>
                <td colspan="9" style="text-align: center; padding: 15px; color: #64748b;">Data barang tidak ditemukan.</td>
            </tr>
        <?php else: ?>
            <?php $no = 1; ?>
            <?php foreach ($daftar_barang as $row): ?>
                <tr style="background: <?= ($no % 2 == 0) ? '#f8fafc' : '#ffffff' ?>;">
                    <td><?= $no++ ?></td>
                    <td><span style="background: #e0f2fe; color: #0369a1; padding: 2px 6px; border-radius: 3px; font-family: monospace;"><?= htmlspecialchars($row['kode_barang']) ?></span></td>
                    <td><b><?= htmlspecialchars($row['nama_barang']) ?></b></td>
                    <td><?= htmlspecialchars($row['kategori']) ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td>
                        <?php if ($row['kondisi'] == 'Baik'): ?>
                            <span style="background: #dcfce7; color: #15803d; padding: 2px 8px; border-radius: 12px; font-size: 13px; font-weight: bold;">Baik</span>
                        <?php else: ?>
                            <span style="background: #fee2e2; color: #b91c1c; padding: 2px 8px; border-radius: 12px; font-size: 13px; font-weight: bold;">Rusak</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['tanggal_masuk']) ?></td>
                    <td style="color: #64748b;"><?= htmlspecialchars($row['keterangan']) ?></td>
                    <td>
                        <a href="index.php?edit=<?= $row['id'] ?>" style="color: #2563eb; text-decoration: none; font-weight: bold;">Edit</a>
                        <span style="color: #cbd5e1;"> | </span>
                        <a href="index.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" style="color: #dc2626; text-decoration: none; font-weight: bold;">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

</div>

</body>
</html>