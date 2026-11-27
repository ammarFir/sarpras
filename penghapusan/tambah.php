<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $tanggal_penghapusan = mysqli_real_escape_string($conn, $_POST['tanggal_penghapusan']);
    $id_sarana           = mysqli_real_escape_string($conn, $_POST['id_sarana']);
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

    // Update jumlah barang di tabel sarana (dikurangi) berdasarkan nama barang
    mysqli_query($conn,"
        UPDATE tabel_sarana
        SET jumlah = jumlah - $jumlah
        WHERE nama_barang='$id_sarana'
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
                    <label class="form-label">Nama Barang (Sarana)</label>
                    <input type="text" name="id_sarana" class="form-control" placeholder="Ketik nama barang..." required>
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
                            <input type="text" name="alasan" class="form-control" placeholder="Contoh: Rusak Berat / Hilang" required>
                        </div>
                    </div>

                </div>

                <button type="submit" name="simpan" class="btn btn-success">Simpan Penghapusan</button>
                <a href="halaman.php?menu=penghapusan" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>