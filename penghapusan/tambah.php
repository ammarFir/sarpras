<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $tanggal_penghapusan = mysqli_real_escape_string($conn, $_POST['tanggal_penghapusan']);
    $id_sarana           = (int) $_POST['id_sarana'];
    $jumlah              = (int) $_POST['jumlah'];
    $alasan              = mysqli_real_escape_string($conn, $_POST['alasan']);
    $no_berita_acara     = mysqli_real_escape_string($conn, $_POST['no_berita_acara']);

    // Simpan data penghapusan
    mysqli_query($conn,"
        INSERT INTO tabel_penghapusan(
            tanggal_penghapusan,
            id_sarana,
            jumlah,
            alasan,
            no_berita_acara
        ) VALUES (
            '$tanggal_penghapusan',
            '$id_sarana',
            '$jumlah',
            '$alasan',
            '$no_berita_acara'
        )
    ");

    // Update jumlah barang di tabel sarana (dikurangi)
    mysqli_query($conn,"
        UPDATE tabel_sarana
        SET jumlah = jumlah - $jumlah
        WHERE id_sarana='$id_sarana'
    ");

    echo "
    <script>
        alert('Data penghapusan berhasil disimpan, stok sarana telah dikurangi');
        window.location='halaman.php?menu=penghapusan';
    </script>
    ";

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Penghapusan Aset
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Penghapusan</label>
                            <input type="date" name="tanggal_penghapusan" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">No. Berita Acara</label>
                            <input type="text" name="no_berita_acara" class="form-control" placeholder="Contoh: BA-01/XI/2023" required>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Barang (Sarana)</label>
                    <select name="id_sarana" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php
                        $sarana = mysqli_query($conn,"SELECT id_sarana, kode_barang, nama_barang, jumlah FROM tabel_sarana ORDER BY nama_barang ASC");
                        while($s = mysqli_fetch_assoc($sarana)){
                        ?>
                        <option value="<?= $s['id_sarana']; ?>">
                            <?= htmlspecialchars($s['kode_barang'] . ' - ' . $s['nama_barang'] . ' (Stok: ' . $s['jumlah'] . ')'); ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jumlah yang Dihapus</label>
                            <input type="number" name="jumlah" class="form-control" min="1" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Alasan Penghapusan</label>
                            <select name="alasan" class="form-select" required>
                                <option value="">-- Pilih Alasan --</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                                <option value="Hilang">Hilang</option>
                                <option value="Usang">Usang</option>
                            </select>
                        </div>
                    </div>

                </div>

                <button type="submit" name="simpan" class="btn btn-success">Simpan Penghapusan</button>
                <a href="halaman.php?menu=penghapusan" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>